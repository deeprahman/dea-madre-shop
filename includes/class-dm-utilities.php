<?php

final class DM_Utilities
{
    /**
     * Returns the tax amount for a given WC_Product object
     *
     * @param WC_Product $product
     * @return float
     */
    public static function getProductTax(WC_Product $product): float
    {
        $include_tax = wc_get_price_including_tax($product);
        $exclude_tax = wc_get_price_excluding_tax($product);
        return (float) ($include_tax -  $exclude_tax);
    }

    /**
     * Get tax rates for a product
     *
     * @param WC_Product $product
     * @return array    ['rate'=> <float>, 'label'=> <string>, 'shipping'=> <string>, 'compound' => <string>]
     */
    public static function getVatRate(WC_Product $product): array|null
    {
        $tax_class = $product->get_tax_class();
        $rates = self::taxRatesForShopLocation($tax_class);

        return $rates[array_key_first($rates)];
    }


    public static function taxRatesForShopLocation(string $tax_class): array
    {
        $location = [
            WC()->countries->get_base_country(),
            WC()->countries->get_base_state(),
            WC()->countries->get_base_postcode(),
            WC()->countries->get_base_city()
        ];

        return WC_Tax::get_rates_from_location($tax_class, $location);
    }

    public static function createPosts(string $title_of_the_page): int
    {
        if (
            $page_obj = get_page_by_title(
                $title_of_the_page,
                'OBJECT',
                'page'
            )
        ) {
            return $page_obj->ID;
        }

        $page_id = wp_insert_post(
            array(
                'comment_status' => 'close',
                'ping_status'    => 'close',
                'post_author'    => 1,
                'post_title'     => ucwords($title_of_the_page),
                'post_name'      => strtolower(str_replace(' ', '-', trim($title_of_the_page))),
                'post_status'    => 'publish',

                'post_type'      => 'page',
                //'id_of_the_parent_page_if_it_available'
            )
        );

        return $page_id;
    }

    public static function errorHandler($error)
    {
        if (is_wp_error($error)) {
            exit($error->get_error_message());
        }
    }

    /**
     * Checks  if the cart needs shipment and shipment cost has been calculated
     *
     * @return bool
     */
    public static function isCartShipmentReady(): bool
    {
        if (!WC()->cart->needs_shipping()) {
            return true;
        } elseif (
            WC()->cart->show_shipping || ('yes' === get_option('woocommerce_enable_shipping_calc'))
        ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public static function registerAccountWIthEmail($email): bool|null
    {

        $username = 'no' === get_option('woocommerce_registration_generate_username') && isset($_POST['username']) ? wp_unslash($_POST['username']) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
        $password = 'no' === get_option('woocommerce_registration_generate_password') && isset($_POST['password']) ? $_POST['password'] : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
        $email    = wp_unslash($email); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

        try {
            $validation_error  = new WP_Error();
            $validation_error  = apply_filters('woocommerce_process_registration_errors', $validation_error, $username, $password, $email);
            $validation_errors = $validation_error->get_error_messages();

            if (1 === count($validation_errors)) {
                throw new Exception($validation_error->get_error_message());
            } elseif ($validation_errors) {
                foreach ($validation_errors as $message) {
                    wc_add_notice('<strong>' . __('Error:', 'woocommerce') . '</strong> ' . $message, 'Error');
                }
                throw new Exception();
            }

            $new_customer = wc_create_new_customer(sanitize_email($email), wc_clean($username), $password);

            if (is_wp_error($new_customer)) {
                $tmp = $new_customer->get_error_message();
                wc_add_notice($new_customer->get_error_message(), 'Error');
                return false;
            }

            if ('yes' === get_option('woocommerce_registration_generate_password')) {
                wc_add_notice(__('Your account was created successfully and a password has been sent to your email address.', 'woocommerce'), 'Success');
            } else {
                wc_add_notice(__('Your account was created successfully. Your login details have been sent to your email address.', 'woocommerce'). 'Success');
            }

            // Only redirect after a forced login - otherwise output a success notice.

        } catch (Exception $e) {
            if ($e->getMessage()) {
                wc_add_notice('<strong>' . __('Error:', 'woocommerce') . '</strong> ' . $e->getMessage(), 'error');
            }
            return false;
        }

        return true;
    }

    	/**
	 * Save and and update a billing or shipping address if the
	 * form was submitted through the user account page.
	 */
	public static function saveAddress() {
		global $wp;

		$nonce_value = wc_get_var( $_REQUEST['woocommerce-edit-address-nonce'], wc_get_var( $_REQUEST['_wpnonce'], '' ) ); // @codingStandardsIgnoreLine.

		if ( ! wp_verify_nonce( $nonce_value, 'woocommerce-edit_address' ) ) {
			return;
		}

		if ( empty( $_POST['action'] ) || 'edit_address' !== $_POST['action'] ) {
			return;
		}

		wc_nocache_headers();

		$user_id = get_current_user_id();

		if ( $user_id <= 0 ) {
			return;
		}

		$customer = new WC_Customer( $user_id );

		if ( ! $customer ) {
			return;
		}

		$load_address = isset( $wp->query_vars['edit-address'] ) ? wc_edit_address_i18n( sanitize_title( $wp->query_vars['edit-address'] ), true ) : 'billing';

		if ( ! isset( $_POST[ $load_address . '_country' ] ) ) {
			return;
		}

		$address = WC()->countries->get_address_fields( wc_clean( wp_unslash( $_POST[ $load_address . '_country' ] ) ), $load_address . '_' );

		foreach ( $address as $key => $field ) {
			if ( ! isset( $field['type'] ) ) {
				$field['type'] = 'text';
			}

			// Get Value.
			if ( 'checkbox' === $field['type'] ) {
				$value = (int) isset( $_POST[ $key ] );
			} else {
				$value = isset( $_POST[ $key ] ) ? wc_clean( wp_unslash( $_POST[ $key ] ) ) : '';
			}

			// Hook to allow modification of value.
			$value = apply_filters( 'woocommerce_process_myaccount_field_' . $key, $value );

			// Validation: Required fields.
			if ( ! empty( $field['required'] ) && empty( $value ) ) {
				/* translators: %s: Field name. */
				wc_add_notice( sprintf( __( '%s is a required field.', 'woocommerce' ), $field['label'] ), 'Error', array( 'id' => $key ) );
			}

			if ( ! empty( $value ) ) {
				// Validation and formatting rules.
				if ( ! empty( $field['validate'] ) && is_array( $field['validate'] ) ) {
					foreach ( $field['validate'] as $rule ) {
						switch ( $rule ) {
							case 'postcode':
								$country = wc_clean( wp_unslash( $_POST[ $load_address . '_country' ] ) );
								$value   = wc_format_postcode( $value, $country );

								if ( '' !== $value && ! WC_Validation::is_postcode( $value, $country ) ) {
									switch ( $country ) {
										case 'IE':
											$postcode_validation_notice = __( 'Please enter a valid Eircode.', 'woocommerce' );
											break;
										default:
											$postcode_validation_notice = __( 'Please enter a valid postcode / ZIP.', 'woocommerce' );
									}
									wc_add_notice( $postcode_validation_notice, 'Error' );
								}
								break;
							case 'phone':
								if ( '' !== $value && ! WC_Validation::is_phone( $value ) ) {
									/* translators: %s: Phone number. */
									wc_add_notice( sprintf( __( '%s is not a valid phone number.', 'woocommerce' ), '<strong>' . $field['label'] . '</strong>' ), 'Error' );
								}
								break;
							case 'email':
								$value = strtolower( $value );

								if ( ! is_email( $value ) ) {
									/* translators: %s: Email address. */
									wc_add_notice( sprintf( __( '%s is not a valid email address.', 'woocommerce' ), '<strong>' . $field['label'] . '</strong>' ), 'Error' );
								}
								break;
						}
					}
				}
			}

			try {
				// Set prop in customer object.
				if ( is_callable( array( $customer, "set_$key" ) ) ) {
					$customer->{"set_$key"}( $value );
				} else {
					$customer->update_meta_data( $key, $value );
				}
			} catch ( WC_Data_Exception $e ) {
				// Set notices. Ignore invalid billing email, since is already validated.
				if ( 'customer_invalid_billing_email' !== $e->getErrorCode() ) {
					wc_add_notice( $e->getMessage(), 'Error' );
				}
			}
		}

		/**
		 * Hook: woocommerce_after_save_address_validation.
		 *
		 * Allow developers to add custom validation logic and throw an error to prevent save.
		 *
		 * @param int         $user_id User ID being saved.
		 * @param string      $load_address Type of address e.g. billing or shipping.
		 * @param array       $address The address fields.
		 * @param WC_Customer $customer The customer object being saved. @since 3.6.0
		 */
		do_action( 'woocommerce_after_save_address_validation', $user_id, $load_address, $address, $customer );

		if ( 0 < wc_notice_count( 'error' ) ) {
			return;
		}

		$customer->save();

		wc_add_notice( __( 'Address changed successfully.', 'deamadre' ) );

		do_action( 'woocommerce_customer_save_address', $user_id, $load_address );


	}

    /**
	 * Gets address data for billing and shipping
	 *
	 * @param string $load_address Type of address to load (billing or shipping).
     * 
     * @return array array('address_type' => `string`"billing/shipping", 'address' => `array`)
	 */
	public static function getAddressData($load_address = 'billing'):array
	{
		$current_user = wp_get_current_user();
		$load_address = sanitize_key($load_address);
		$country      = get_user_meta(get_current_user_id(), $load_address . '_country', true);

		if (!$country) {
			$country = WC()->countries->get_base_country();
		}

		if ('billing' === $load_address) {
			$allowed_countries = WC()->countries->get_allowed_countries();

			if (!array_key_exists($country, $allowed_countries)) {
				$country = current(array_keys($allowed_countries));
			}
		}

		if ('shipping' === $load_address) {
			$allowed_countries = WC()->countries->get_shipping_countries();

			if (!array_key_exists($country, $allowed_countries)) {
				$country = current(array_keys($allowed_countries));
			}
		}

		$address = WC()->countries->get_address_fields($country, $load_address . '_');

		// Enqueue scripts.
		wp_enqueue_script('wc-country-select');
		wp_enqueue_script('wc-address-i18n');

		// Prepare values.
		foreach ($address as $key => $field) {

			$value = get_user_meta(get_current_user_id(), $key, true);

			if (!$value) {
				switch ($key) {
					case 'billing_email':
					case 'shipping_email':
						$value = $current_user->user_email;
						break;
				}
			}

			$address[$key]['value'] = apply_filters('woocommerce_my_account_edit_address_field_value', $value, $key, $load_address);
		}

        return [
            'address_type' => $load_address,
            'address' => $address
        ];
	}
}

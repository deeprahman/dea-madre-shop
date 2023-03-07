<?php


class DM_Address_Saver
{

    /**
     * User Id
     *
     * @var Int
     */
    private $uid;

    /**
     * Customer Instance
     *
     * @var WC_Customer
     */
    private $customer;

    public function __construct(int $uid)
    {
        if ($uid <= 0) {
            return new WP_Error(400, __('User not Found', 'deamadre'), ['uid' => $uid]);
        }
        $this->uid = $uid;
        $this->customer = new WC_Customer($this->uid);
         if (!$this->customer) {
            return new WP_Error(400, __('Customer could not be loaded'));
        }
    }

    

    /**
     * Save and and update a billing or shipping address if the
     * form was submitted through the user account page.
     */
    public function save_address()
    {
        global $wp;
        $user_id =& $this->uid;
        $customer =& $this->customer;

        wc_nocache_headers();



        $load_address = isset($wp->query_vars['edit-address']) ? wc_edit_address_i18n(sanitize_title($wp->query_vars['edit-address']), true) : 'billing';

        if (!isset($_POST[$load_address . '_country'])) {
            return;
        }

        $address = WC()->countries->get_address_fields(wc_clean(wp_unslash($_POST[$load_address . '_country'])), $load_address . '_');

        foreach ($address as $key => $field) {
            if (!isset($field['type'])) {
                $field['type'] = 'text';
            }

            // Get Value.
            if ('checkbox' === $field['type']) {
                $value = (int) isset($_POST[$key]);
            } else {
                $value = isset($_POST[$key]) ? wc_clean(wp_unslash($_POST[$key])) : '';
            }

            // Hook to allow modification of value.
            $value = apply_filters('woocommerce_process_myaccount_field_' . $key, $value);

            // Validation: Required fields.
            if (!empty($field['required']) && empty($value)) {
                /* translators: %s: Field name. */
                wc_add_notice(sprintf(__('%s is a required field.', 'woocommerce'), $field['label']), 'error', array('id' => $key));
            }

            if (!empty($value)) {
                // Validation and formatting rules.
                if (!empty($field['validate']) && is_array($field['validate'])) {
                    foreach ($field['validate'] as $rule) {
                        switch ($rule) {
                            case 'postcode':
                                $country = wc_clean(wp_unslash($_POST[$load_address . '_country']));
                                $value   = wc_format_postcode($value, $country);

                                if ('' !== $value && !WC_Validation::is_postcode($value, $country)) {
                                    switch ($country) {
                                        case 'IE':
                                            $postcode_validation_notice = __('Please enter a valid Eircode.', 'woocommerce');
                                            break;
                                        default:
                                            $postcode_validation_notice = __('Please enter a valid postcode / ZIP.', 'woocommerce');
                                    }
                                    wc_add_notice($postcode_validation_notice, 'error');
                                }
                                break;
                            case 'phone':
                                if ('' !== $value && !WC_Validation::is_phone($value)) {
                                    /* translators: %s: Phone number. */
                                    wc_add_notice(sprintf(__('%s is not a valid phone number.', 'woocommerce'), '<strong>' . $field['label'] . '</strong>'), 'error');
                                }
                                break;
                            case 'email':
                                $value = strtolower($value);

                                if (!is_email($value)) {
                                    /* translators: %s: Email address. */
                                    wc_add_notice(sprintf(__('%s is not a valid email address.', 'woocommerce'), '<strong>' . $field['label'] . '</strong>'), 'error');
                                }
                                break;
                        }
                    }
                }
            }

            try {
                // Set prop in customer object.
                if (is_callable(array($customer, "set_$key"))) {
                    $customer->{"set_$key"}($value);
                } else {
                    $customer->update_meta_data($key, $value);
                }
            } catch (WC_Data_Exception $e) {
                // Set notices. Ignore invalid billing email, since is already validated.
                if ('customer_invalid_billing_email' !== $e->getErrorCode()) {
                    wc_add_notice($e->getMessage(), 'error');
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
        do_action('woocommerce_after_save_address_validation', $user_id, $load_address, $address, $customer);

        if (0 < wc_notice_count('error')) {
            return 0;
        }

        $customer->save();

        wc_add_notice(__('Address changed successfully.', 'woocommerce'));

        do_action('woocommerce_customer_save_address', $user_id, $load_address);
        return 1;
    }

 
}

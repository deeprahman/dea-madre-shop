<?php
declare(strict_types=1);
class DM_Product_List {

    /**
     * GEt Products according to the given parameter value
     *
     * @param array $params
     * @return array
     */
  public function getProducts(array $params = array( 'limit' => -1 )):array {
    $res = [];
    // Get all the products
    $products = wc_get_products( $params );

    // Loop through the products
    foreach ( $products as $product ) {
        $tmp = new StdClass();
      // Get the add-to-cart link
      $tmp->addToCartLink = $product->add_to_cart_url();

      // Get the product categories
      $product_categories = get_the_terms( $product->get_id(), 'product_cat' );
      $product_category_names = array();
      foreach ( $product_categories as $product_category ) {
        $product_category_names[] = $product_category->name;
      }
      $tmp->productCatNames = $product_category_names;
      // Get the product name
      $tmp->productName = $product->get_name();

      // Get the product price
      $tmp->productPrice = $product->get_price();

      // Get the product link
      $tmp->productLink = $product->get_permalink();

      // Get the product image
      $tmp->productImage = (wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'single-post-thumbnail' ))[0];
      
      array_push($res, $tmp);

    }
    return $res;
  }
}
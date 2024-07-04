# WooCommerce EasyCheckout 2.0

So this is an updated version of [WooCommerce EasyCheckout](https://github.com/Barden0/WooCommerce-EasyCheckout)

The reason why I did not update the original plugin is to leave it as minimalistic as possible for those who just want a plugin that works without extra features. With this new version I added the option to choose which billing fields you want to turn off and a WordPress admin settings page to give you much more flexibility.

## Features:

- **Product Type Detection:** The plugin detects the product type in the user's cart:
  - **Digital Products Only:** If the cart contains ONLY digital products (virtual/downloadable), it hides the specified billing fields and asks for only the name and email address.
  - **Physical Products Only:** If the cart contains only physical products, it uses the original billing fields.
  - **Mixed Cart:** If the cart contains both types, it uses the original billing fields so the seller can have a shipping address to send the physical products.

- **Admin Settings Page:** A settings page in the WordPress admin allows you to customize which billing fields to hide when the cart contains only digital products. You can choose to hide fields such as address, city, postcode, country, state, and phone.

- **User-Friendly:** Easily configurable through the WordPress admin panel, making it simple to adjust the plugin to your needs without touching any code.

### Open to contributions and feedback!

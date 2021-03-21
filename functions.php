<?php

$config = [
  'itensPorPagina' => 6
];

add_action('after_setup_theme', function () { 
  add_theme_support('woocommerce');
});

add_action('wp_enqueue_scripts', function () {
  wp_register_style('ff-style', get_template_directory_uri() . '/style.css', [], '1.0.0', false);
  wp_enqueue_style('ff-style');
});

add_action('after_setup_theme', function () {
  add_image_size('slide', 1000, 800, ['center', 'top']);
  update_option('medium_crop', 1);
});

add_filter('loop_shop_per_page', function () { 
  return $config['itensPorPagina'];
});

?>

<?php function ff_renderizar_lista_de_produtos($lista_de_produtos) { ?>
  <ul class="produtos-lista">
    <?php foreach($lista_de_produtos as $produto) { ?>
      <li class="produto-item">
        <a href="<?= $produto['link']; ?>">
          <div class="produto-info">
            <img src="<?= $produto['img']; ?>" alt="<?= $produto['nome']; ?>"/>
            <h2><?= $produto['nome']; ?> - <span><?= $produto['price']; ?></span></h2>
          </div>
          <div class="produto-item_overlay">
            <span class="btn-link">Ver Mais</span>
          </div>
        </a>
      </li>
    <?php } ?>
  </ul>
<?php } ?>
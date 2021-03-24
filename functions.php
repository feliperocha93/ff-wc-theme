<?php

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
  $ITENS_POR_PAGINA = 6; 
  return $ITENS_POR_PAGINA;
});

function remover_classes_do_body($classes) {
  $woo_class = array_search('woocommerce', $classes);
  $woopage_class = array_search('woocommerce-page', $classes);
  //Verificar se existe essas classes dentro do array
  $search = in_array('archive', $classes) || in_array('product-template-default', $classes);
  if($woo_class && $woopage_class && $search) {
    unset($classes[$woo_class]);
    unset($classes[$woopage_class]);
  }
  return $classes;
}
add_filter('body_class', 'remover_classes_do_body');

?>

<?php function ff_formatar_produtos($produtos, $img_tamanho = 'medium') {
  $produtos_formatados = [];
  foreach($produtos as $produto) {
    $produtos_formatados[] = [
      'nome' => $produto->get_name(),
      'preco' => $produto->get_price_html(),
      'link' => $produto->get_permalink(),
      'img' => wp_get_attachment_image_src($produto->get_image_id(), $img_tamanho)[0],
    ];
  }
  return $produtos_formatados;
}
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
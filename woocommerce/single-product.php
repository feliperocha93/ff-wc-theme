<?php get_header(); ?>

<?php 
  function formatar_produto_unico($id, $tamanho_img = 'medium') {
    $produto = wc_get_product($id);

    $galeria_ids = $produto->get_gallery_attachment_ids();
    $galeria = [];
    if ($galeria_ids) {
      foreach($galeria_ids as $img_id) {
        $galeria[] = wp_get_attachment_image_src($img_id, $tamanho_img)[0];
      }
    }

    return [
      'id' => $id,
      'nome' => $produto->get_name(),
      'preco' => $produto->get_price_html(),
      'link' => $produto->get_permalink(),
      'sku' => $produto->get_sku(),
      'descricao' => $produto->get_description(),
      'img' => wp_get_attachment_image_src($produto->get_image_id(), $tamanho_img)[0],
      'galeria' => $galeria,
    ];
  }
?>

<div class="container breadcrumb">
  <?php woocommerce_breadcrumb(['delimiter' => ' > ']); ?>
</div>

<div class="container notificacao">
  <?php wc_print_notices(); ?>
</div>

<main class="container product">
  <?php if(have_posts()) { while (have_posts()) {the_post(); 
    $produto = formatar_produto_unico(get_the_ID());
  ?>
    <div class="product-gallery" data-gallery="gallery">
      <div class="product-gallery-list">
        <?php foreach($produto['galeria'] as $img) { ?>
          <img data-gallery="list" src="<?= $img; ?>" alt="<?= $produto['nome']; ?>">
        <?php } ?>
      </div>
      <div class="produto-gallery-main">
        <img data-gallery="main" src="<?= $produto['img']; ?>" alt="<?= $produto['nome']; ?>">
      </div>
    </div>
    <div class="product-detail">
      <small><?= $produto['sku']; ?></small>
      <h1><?= $produto['nome']; ?></h1>
      <p class="product-price"><?= $produto['preco']; ?></p>
      <?php woocommerce_template_single_add_to_cart(); ?>
      <h2>Descrição</h2>
      <p><?= $produto['descricao']; ?></p>
    </div>
  <?php } } ?>
</main>

<?php
  $relacionados_ids = wc_get_related_products($produto['id'], 6);
  $produtos_relacionados = [];
  foreach($relacionados_ids as $produto_id) {
    $produtos_relacionados[] = wc_get_product($produto_id);
  }
  $relacionados = ff_formatar_produtos($produtos_relacionados);
?>

<section class="container-separador">
  <div class="container">
    <h2 class="subtitulo">Relacionados</h2>
    <?php ff_renderizar_lista_de_produtos($relacionados); ?>
  </div>
</section>

<?php get_footer(); ?>

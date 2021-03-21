<?php
// Template Name: Home
get_header(); ?>

<?php 
$produtos_slide = wc_get_products([
  'limit' => 6,
  'tag' => ['slide'],
]);

function formatar_produtos($produtos) {
  $produtos_formatados = [];
  foreach($produtos as $produto) {
    $produtos_formatados[] = [
      'nome' => $produto->get_name(),
      'preco' => $produto->get_price_html(),
      'link' => $produto->get_permalink(),
      'img' => wp_get_attachment_image_src($produto->get_image_id(), 'slide')[0],
    ];
  }
  return $produtos_formatados;
}

$produtos_formatados = formatar_produtos($produtos_slide);
?>

<?php if(have_posts()) { while (have_posts()) {the_post(); ?>

<ul class="vantagens">
  <li>Frete Grátis</li>
  <li>Troca fácil</li>
  <li>Até 12x</li>
</ul>

<section class="slide-wrapper">
  <ul class="slide">
    <?php foreach($produtos_formatados as $produto) { ?>
      <li class="slide-item">
        <img src="<?= $produto['img']; ?>" alt="<?= $produto['nome']; ?>">
        <div class="slide-info">
          <span class="slide-preco"><?= $produto['preco']; ?></span>
          <h2 class="slide-nome"><?= $produto['nome']; ?></h2>
          <a href="<?= $produto['link']; ?>" class="slide-link">Ver Produto</a>
        </div>
      </li>
    <?php } ?>
  </ul>
</section>

<?php } } ?>

<?php get_footer(); ?>

<?php
// Template Name: Home
get_header(); ?>

<pre>
<?php 

function formatar_produtos($produtos, $img_tamanho) {
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

$produtos_lancamentos = wc_get_products([
  'limit' => 9,
  'orderby' => 'date',
  'order' => 'DESC'
]);

$produtos_mais_vendidos = wc_get_products([
  'limit' => 9,
  'meta_key' => 'total_sales',
  'orderby' => 'meta_value_num',
  'order' => 'DESC'
]);

$produtos_slide = wc_get_products([
  'limit' => 6,
  'tag' => ['slide'],
]);

$data = [];

$data['lancamentos'] = formatar_produtos($produtos_lancamentos, 'medium');
$data['mais_vendidos'] = formatar_produtos($produtos_mais_vendidos, 'medium');
$data['slide'] = formatar_produtos($produtos_slide, 'slide');
?>
</pre>

<?php if(have_posts()) { while (have_posts()) {the_post(); ?>

<ul class="vantagens">
  <li>Frete Grátis</li>
  <li>Troca fácil</li>
  <li>Até 12x</li>
</ul>

<section class="slide-wrapper">
  <ul class="slide">
    <?php foreach($data['slide'] as $produto) { ?>
      <li class="slide-item">
        <img src="<?= $produto['img']; ?>" alt="<?= $produto['nome']; ?>">
        <div class="slide-info">
          <span class="slide-preco"><?= $produto['preco']; ?></span>
          <h2 class="slide-nome"><?= $produto['nome']; ?></h2>
          <a href="<?= $produto['link']; ?>" class="btn-link">Ver Produto</a>
        </div>
      </li>
    <?php } ?>
  </ul>
</section>

<section class="container">
  <h1 class="subtitulo">Lançamentos</h1>
  <?php ff_renderizar_lista_de_produtos($data['lancamentos']); ?>
</section>

<section class="container">
  <h1 class="subtitulo">Mais vendidos</h1>
  <?php ff_renderizar_lista_de_produtos($data['mais_vendidos']); ?>
</section>

<?php } } ?>

<?php get_footer(); ?>

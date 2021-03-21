<?php get_header(); ?>
<?php
$produtos = [];
if(have_posts()) { while(have_posts()) { the_post();
  $produtos[] = wc_get_product(get_the_ID());
} }

$data = [];
$data['produtos'] = ff_formatar_produtos($produtos);
?>

<div class="container breadcrumb">
  <?php woocommerce_breadcrumb(['delimiter' => ' > ']); ?>
</div>

<article class="container produtos-arquivo">
  <nav class="filtros">
    <h2>Filtros</h2>
  </nav>
  <main>
    <?php if($data['produtos'][0]) { ?>
      <?php ff_renderizar_lista_de_produtos($data['produtos']); ?>
      <?= get_the_posts_pagination(); ?>
    <?php } else { ?>
      <p>Nenhum resultado para a sua busca.</p>
    <?php } ?>
  </main>
</article>

<?php get_footer(); ?>
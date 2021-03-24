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
    <div class="filtro">
      <h3 class="filtro-titulo">
        Categorias
      </h3>
      <?php 
        wp_nav_menu([
          'menu' => 'categorias-interna',
          'container_class' => 'filtro-cat',
          'container' => false,
        ]);
      ?>
    </div>
    <div class="filtro">
      <?php 
        $atributos_taxonomias = wc_get_attribute_taxonomies();
        foreach($atributos_taxonomias as $atributo) {
          the_widget('WC_Widget_Layered_Nav', [
            'title' => $atributo->attribute_label,
            'attribute' => $atributo->attribute_name,
          ]);
        }
      ?>
    </div>
    <div class="filtro">
      <form class="filtro-preco" action="<?= $_SERVER['REQUEST_URI']; ?>">
        <div>
          <label for="min_price">De R$</label>
          <input type="text" name="min_price" id="min_price" value="<?= $_GET['min_price']; ?>">
        </div>
        <div>
          <label for="max_price">Até R$</label>
          <input type="text" name="max_price" id="max_price" value="<?= $_GET['max_price']; ?>">
        </div>
        <button type="submit">Filtrar</button>
      </form>
    </div>
  </nav>
  <main>
    <?php if($data['produtos'][0]) { ?>
      <?php woocommerce_catalog_ordering(); ?>
      <?php ff_renderizar_lista_de_produtos($data['produtos']); ?>
      <?= get_the_posts_pagination(); ?>
    <?php } else { ?>
      <p>Nenhum resultado para a sua busca.</p>
    <?php } ?>
  </main>
</article>

<?php get_footer(); ?>
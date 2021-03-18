<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php bloginfo('name'); ?> <?php wp_title('|'); ?></title>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <?php 

  $img_url = get_stylesheet_directory_uri() . '/img';
  $img_mascote_300 = $img_url . '/fuma-forte-headshop-mascote-300x.png';

  $qtd_itens_carrinho = WC()->cart->get_cart_contents_count();

  ?>

    <header class="header">
      <a href="/"><img src="<?= $img_mascote_300; ?>" alt="Fuma Forte Headshop"></a>
      <div class="busca">
        <form action="<?php bloginfo('url'); ?>/loja/" method="get">
          <input
            type="text"
            name="campo-busca"
            id="campo-busca"
            placeholder="Buscar"
            value="<?php the_search_query(); ?>"
          >
          <input type="text" name="post_type" value="product" class="hidden">
          <input type="submit" id="botao-busca" value="Buscar">
        </form>
      </div>

      <nav class="conta">
        <a
          href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"
          title="Ir para minha conta"
          class="minha-conta"
          >
          Minha conta
        </a>
        <a
          href="<?php echo wc_get_cart_url(); ?>"
          title="Ir para o carrinho de compras"
          class="carrinho"
          >
          Carrinho
          <?php if($qtd_itens_carrinho) { ?>
            <span class="numero-itens-carrinho" <?= $qtd_itens_carrinho ?>></span>
          <?php } ?>
        </a>
      </nav>
    </header>

    <?php 
      wp_nav_menu([
        'menu' => 'categorias',
        'container' => 'nav',
        'container_class' => 'menu-categorias',
      ]);
    ?>



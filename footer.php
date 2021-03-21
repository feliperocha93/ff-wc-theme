<pre>
  <?php 

  $pagina_home = get_page_by_path('home');
  $formas_pagamento_string = get_post_meta($pagina_home->ID, 'formas_pagamento', true);
  $formas_pagamento_array = explode(', ', $formas_pagamento_string);

  ?>
</pre>

<footer class="footer">
  <img src="<?= get_stylesheet_directory_uri(); ?>/img/icons/handel-white.svg" alt="Logo da Fuma Forte Headshop">
  <div class="container footer-info">
    <section>
      <h3>Páginas</h3>
        <?php 
        wp_nav_menu([
          'menu' => 'footer',
          'container' => 'nav',
          'container_class' => 'footer-menu',
        ]);
        ?>
    </section>
    <section>
      <h3>Redes Sociais</h3>
        <?php 
        wp_nav_menu([
          'menu' => 'redes',
          'container' => 'nav',
          'container_class' => 'footer-redes',
        ]);
        ?>
    </section>
    <section>
      <h3>Pagamentos</h3>
        <ul>
          <?php foreach($formas_pagamento_array as $forma_pagamento) { ?>
          <li><?= $forma_pagamento; ?></li>
          <?php } ?>
        </ul>
    </section>
  </div>

  <small class="footer-copy">Fuma Forte Headshop &copy; <?= date('Y'); ?></small>
</footer>

<?php wp_footer(); ?>
<script src="<?= get_stylesheet_directory_uri(); ?>/js/slide.js"></script>
<script src="<?= get_stylesheet_directory_uri(); ?>/js/script.js"></script>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?= link_tag('css/style.css', 'stylesheet') ?>
    <?= link_tag('icons/apple-touch-icon.png', 'apple-touch-icon') ?>
    <?= link_tag('icons/apple-touch-icon.png', 'apple-touch-icon', 'image/png') ?>
    <?= link_tag('icons/favicon-32x32.png', 'icon', 'image/png') ?>
    <?= link_tag('icons/favicon-16x16.png', 'icon', 'image/png') ?>
    <?= link_tag('icons/site.webmanifest', 'manifest') ?>
    <title>Signed up!</title>
  </head>

  <body>
    <section>
      <div>
        <h3 class="is-center">
          Please check your email, we have sent you a verification link.
        </h3>
      </div>
      <div class="is-center">
        <?= img('images/undraw_Letter.svg')?>
    </div>
    </section>
  </body>
</html>

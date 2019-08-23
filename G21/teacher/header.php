<?php	if(count(get_required_files()) == 1 || count(get_included_files()) == 1) {
		header("HTTP/1.1 404 File Not Found", 404);
		exit();
	}
?>
<head>
<link rel="stylesheet" href="../css/header.css">
</head>
  <header class="header">
    <div class="container">
      <div class="Header-container">
        <a class="Header-logo" href="https://www.monogranofelicetti.it/en/">
        <div class="Logo"></div></a>
        <nav class="Header-nav">
          <ul class="Header-navList">
            <li class="Header-navItem h6">
              <a class="Header-navLink" href="https://www.monogranofelicetti.it/en/quality-pasta-born-at-1000-meters/">Born at 1000 meters</a>
            </li>
            <li class="Header-navItem h6">
              <a class="Header-navLink" href="https://www.monogranofelicetti.it/en/online-pasta-shop/">Shop</a>
            </li>
            <li class="Header-navItem h6">
              <a class="Header-navLink" href="https://www.monogranofelicetti.it/en/chefs/">Chefs</a>
            </li>
            <li class="Header-navItem h6">
              <a class="Header-navLink" href="https://www.monogranofelicetti.it/en/activities/">Activities</a>
            </li>
            <li class="Header-navItem h6">
              <a class="Header-navLink" href="https://www.monogranofelicetti.it/en/recipes/">Recipes</a>
            </li>
          </ul>
        </nav>
        <div class="Header-languages">
          <div class="MiniLang js-miniLang">
            <div class="MiniLang-toggle h6" data-minilang-toggle="">
              <a class="MiniLang-toggle-link">EN</a>
            </div>
            <div class="MiniLang-popup">
              <ul class="MiniLang-list">
                <li class="MiniLang-item">
                  <a class="MiniLang-link no-barba" href="https://www.monogranofelicetti.it/it/">IT</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="Header-account h6">
          <a class="Header-accountLink no-barba" href="https://shop.monogranofelicetti.it/index.php?route=account/login">Login</a>
        </div>
        <div class="Header-cart">
          <div class="MiniCart js-miniCart" data-url="https://www.monogranofelicetti.it/en/minicart/">
            <a class="MiniCart-toggle no-barba" data-minicart-toggle="" href="https://shop.monogranofelicetti.it/index.php?route=checkout/cart"><span class="MiniCart-total MiniCart-hideIfEmpty" data-minicart-total="">0</span> <svg class="Icon MiniCart-hideIfFull" height="29" viewbox="0 0 32 29" width="32">
            <use xlink:href="#icon-cart-empty"></use></svg> <svg class="Icon MiniCart-hideIfEmpty" height="29" viewbox="0 0 32 29" width="32">
            <use xlink:href="#icon-cart-full"></use></svg></a>
            <div class="MiniCart-popup">
              <div class="MiniCart-content MiniCart-hideIfEmpty" data-minicart-content=""></div>
              <div class="MiniCart-content MiniCart-hideIfFull">
                <p class="MiniCart-message">Your cart is empty</p>
              </div>
              <div class="MiniCart-actions">
                <div class="MiniCart-hideIfFull">
                  <a class="Button Button--primary Button--block" href="https://www.monogranofelicetti.it/en/online-pasta-shop/">Add products</a>
                </div>
                <div class="MiniCart-hideIfEmpty">
                  <a class="Button Button--primary Button--block no-barba" href="https://shop.monogranofelicetti.it/index.php?route=checkout/cart">Cart</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="Header-menu js-menuToggle" role="button">
          <svg class="Icon" height="18" viewbox="0 0 28 18" width="28">
          <use xlink:href="#icon-menu"></use></svg>
        </div>
      </div>
      <nav>
        <ul class="left">
          <li>Welcome <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></li>
        </ul>
        <div class="right">
          <form action="../php/logout.inc.php" method="post">
            <input name="logout-submit" type="submit" value="Logout">
          </form>
        </div>
      </nav>
    </div>
  </header>

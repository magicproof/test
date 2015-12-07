<?php $this->headScript("/html_public/js/jquery-1.11.3.js"); ?>
<?php $this->headTitle("main page"); ?>
<?php $this->headLink("/html_public/css/style.css"); ?>
<?php echo $this->doctype() ?>
<html>
    <head>
        <?php echo $this->headMeta(); ?>
        <?php echo $this->headLink(); ?>
        <?php echo $this->headScript(); ?>
        <?php echo $this->headTitle(); ?>
    </head>
    <body>
        <div class="header"></div>
        <?php echo $this->getContent(); ?>
        <div class="layer">
            <form id='footer' action="" method="post">
                <label>Name:</label>
                <input type="text" name="nameForm" placeholder="Jane Doe">
                <label class="mail"> E-mail:</label>
                <input type="text" name="emailForm" placeholder="JaneDoe@example.com">
                <label class="file"> File:</label>
                <input class="mail chooseButton" type="file" name="Choose File" accept="image/*">
                <button class="chooseButton subscribe">Subscribe</button>
            </form>
        </div>
    </body>
</html>
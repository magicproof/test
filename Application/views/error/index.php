<?php $this->headTitle("Error 404"); ?>
<div id="content">
    <h2>Error 404</h2>
    <p>
        <?php echo $this->exception->getMessage() ?>
    </p>
    <pre><?php echo $this->exception->getTraceAsString(); ?></pre>
    <p><strong>Requested params:</strong></p>
    <div id ="requested-param">
        <?php if (!$this->params): ?>
            <?php echo "No params" ?>
        <?php endif; ?>
        <?php foreach ($this->params as $key => $value): ?>
            <?php echo "[$key] = $value"; ?><br>
        <?php endforeach; ?>
    </div>
    <p>Unfortunately, the page you requested was not found</p>
    <p>Why?</p>
    <ol>
        <li>The link you followed is incorrect.
        <li>You did not specify a path or page name.
        <li>The page was remote since your last visit.
    </ol>
    <p>To continue work with the site you can go to:</p>
    <ul>
        <li><a href="/">Main page of site</a>
    </ul>
</div>

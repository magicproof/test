<?php $this->headTitle("Video List"); ?>
<div id="content">
    <h2>Video List</h2>
    <?php foreach ($this->data as $value): ?>
        <?php echo $value["name"]; ?>
        <br>
    <?php endforeach; ?>
</div>
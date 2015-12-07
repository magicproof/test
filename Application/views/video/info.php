<?php $this->headTitle("Video info"); ?>
<div id="content">
    <h2>Video and Subtitle List</h2>
    <table class="view-table">
        <tr>
            <th>Video</th>
            <th>Subtitle</th>
        </tr>
        <?php foreach ($this->data as $value): ?> 
            <?php if (!isset($value["subtitle"])): ?> 
                <?php $value["subtitle"] = "empty"; ?>
            <?php endif ?>
            <tr>
                <td><?php echo $value["name"]; ?></td>
                <td><?php echo $value["subtitle"]; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

 
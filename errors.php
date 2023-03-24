<?php if(count($errors) > 0): ?>
    <div style="border:1px solid red; padding:5px 0px; margin-top:8px; background:rgb(255, 227, 227);" class="error red">
        <?php foreach($errors as $error): ?>
            <p style="margin:1px;font-size:12px;"><?php echo $error; ?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>
<ul class="form-actions">
  <?php foreach ($actions as $action): ?>
    <li>
      <button type="submit" <?php if (isset($action['name'])): ?>name="<?php echo $action['name']; ?>"<?php endif; ?> <?php if (isset($action['onclick'])): ?>onclick="<?php echo $action['onclick']; ?>" <?php endif; ?>><?php echo $action->getRaw('label'); ?></button>
    </li>
  <?php endforeach; ?>
</ul>

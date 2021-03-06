<div class="table-responsive">
  <table class="table table-hover table-condensed">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Created at</th>
        <th>Controls</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($data['events']): ?>
        <?php foreach ($data['events'] as $event): ?>
          <tr>
            <td><?= $event['id'] ?></td>
            <td>
              <a href="event_show.php?id=<?= $event['id'] ?>"><?= $event['name'] ?></a>
            </td>
            <td><?= $event['created_at'] ?></td>
            <td>
              <a href="_get/destroy_event.php?id=<?= $event['id'] ?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Delete this event." sweet-alert="link">
                <i class="fa fa-times-circle"></i>
              </a>
              <a href="event_edit.php?id=<?= $event['id'] ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Modify this event.">
                <i class="fa fa-edit"></i>
              </a>
              <a href="_get/event_associate_user.php?id=<?= $event['id'] ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Associate you to this event.">
                <i class="fa fa-exchange"></i>
              </a>
            </td>
          </tr>
        <?php endforeach ?>
      <?php endif ?>
    </tbody>
  </table>
</div>

<?php include '../modals/event_create.php'; ?>

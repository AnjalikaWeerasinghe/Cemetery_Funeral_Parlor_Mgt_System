<?php 
include_once(__DIR__ . "/../../routes/notification/load_notifications_route.php");

?>

<div class="container-fluid mt-5 pt-5">

    <div class="card shadow border-0 rounded-4">

        <div class="card-header text-white" style="background:linear-gradient(to right,#8b6f47,#d4af7a);">
            <h4 class="mb-0">
                <i class="fa-solid fa-bell"></i>Notifications
            </h4>
        </div>

        <div class="card-body p-0">

            <table class="table table-hover mb-0">

                <thead>

                    <tr>
                        <th>Title</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th width="120">Action</th>
                    </tr>

                </thead>

                <tbody>

                <?php foreach($notifications as $notification): ?>

                    <tr class="<?= $notification['is_read'] ? '' : 'table-warning' ?>">

                        <td><?= htmlspecialchars($notification['title']) ?></td>

                        <td><?= htmlspecialchars($notification['message']) ?></td>

                        <td><?= date("d M Y h:i A", strtotime($notification['created_at'])) ?></td>

                        <td>

                            <?php if($notification['is_read']){ ?>
                                <span class="badge bg-success">Read</span>
                            <?php } else { ?>
                                <span class="badge bg-danger">Unread</span>
                            <?php } ?>

                        </td>

                        <td>
                            <a href="../routes/notification/mark_notification_read.php?id=<?= $notification['notification_id']; ?>" class="btn btn-sm btn-primary">
                                <i class='fa-solid fa-eye'></i>
                            </a>
                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>
<?php

  if(!empty($_GET['delete-admin'])){

    $id = $_GET['delete-admin'];

    $delete_admin = mysqli_query($database , "UPDATE users SET admin = 0 WHERE id = '$id' ");

    if($delete_admin){
      echo user_alert("User delete of admin successful." , "success");
    }else {
      echo user_alert("Error to set as admin." , "danger");
    }


  }

  if(!empty($_GET['set-admin'])){

    $id = $_GET['set-admin'];

    $set_admin = mysqli_query($database , "UPDATE users SET admin = 1 WHERE id = '$id' ");

    if($set_admin){
      echo user_alert("User set as admin successful." , "success");
    }else {
      echo user_alert("Error to set as admin." , "danger");
    }

  }



  $sql = "SELECT * FROM users";
  $users = mysqli_query($database , $sql);






?>

<div class="container">
  <h2>Manager Users</h2>
  <p>Here you view and delete the users info.</p>



    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">id</th>
          <th scope="col">User name</th>
          <th scope="col">Email</th>
          <th scope="col">Admin</th>
        </tr>
      </thead>
      <tbody>

        <!--Loop over users on database-->
        <?php while ($user = mysqli_fetch_assoc($users)): ?>
          <?php
            $id = $user['id'];
            $username = $user['username'];
            $email = $user['email'];
            $picture = $user['picture'];
            $admin = $user['admin'];
          ?>
          <tr>
            <td><?= $id ?></td>
            <td><?= $username ?></td>
            <td><?= $email ?></td>
            <!--Modal for change admin settings in this user-->
            <td>
              <?php if($admin): ?>
                <?php if($id == 1): ?>
                  <a class="btn btn-warning btn-lg active" role="button" aria-pressed="true">Admin Master</a>
                <?php else: ?>
                  <!--Send variable get to this page-->
                  <a href="manage.php?manager=users&delete-admin=<?= $id ?>" class="btn btn-danger btn-lg active" role="button" aria-pressed="true">Delete of admins</a>
                <?php endif; ?>
              <?php else: ?>
                <!--Send variable get to this page-->
                <a href="manage.php?manager=users&set-admin=<?= $id ?>" class="btn btn-success btn-lg active" role="button" aria-pressed="true">Set as administrator</a>
              <?php endif; ?>
            </td>

          </tr>

      <?php endwhile; ?>

      </tbody>

    </table>

</div>

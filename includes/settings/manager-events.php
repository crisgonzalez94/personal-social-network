<?php

  /*Get info of home from database*/
  $sql = "SELECT * FROM events";
  $events = mysqli_query($database , $sql);





?>



<div class="container">
  <h2>Manager Posts</h2>
  <p>Here you view and delete the posts.</p>

  <h3>Posts</h3>

    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">id</th>
          <th scope="col">Title</th>
          <th scope="col">Short description</th>
          <th scope="col">Body</th>
          <th scope="col">Date</th>
        </tr>
      </thead>
      <tbody>

        <?php

          while($event = mysqli_fetch_assoc($events)){
            $id = $event['id'];
            $title = $event['title'];
            $short_description = $event['short_description'];
            $body = $event['body'];
            /*Error to write data base :) :)*/
            $date_event = $event['date_post'];

            echo "<tr>
                    <td>$id</td>
                    <td>$title</td>
                    <td>$short_description</td>
                    <td>$body</td>
                    <td>$date_event</td>
                  </tr>";
          }

        ?>

        </tr>
      </tbody>

    </table>

</div>

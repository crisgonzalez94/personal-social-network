<?php

  /*Get info of home from database*/
  $sql = "SELECT * FROM podcasts";
  $podcasts = mysqli_query($database , $sql);





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
          <th scope="col">Date</th>
        </tr>
      </thead>
      <tbody>

        <?php

          while($podcast = mysqli_fetch_assoc($podcasts)){
            $id = $podcast['id'];
            $title = $podcast['title'];
            $short_description = $podcast['short_description'];
            $date_post = $podcast['date_post'];

            echo "<tr>
                    <td>$id</td>
                    <td>$title</td>
                    <td>$short_description</td>
                    <td>$date_post</td>
                  </tr>";
          }

        ?>

        </tr>
      </tbody>

    </table>

</div>

<?php

  /*Get info of home from database*/
  $sql = "SELECT * FROM posts";
  $posts = mysqli_query($database , $sql);





?>



<div class="container">
  <h2>Manager Posts</h2>
  <p>Here you view and delete the posts.</p>

  <h3>Posts</h3>

    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">id</th>
          <th scope="col">Titulo</th>
          <th scope="col">Short description</th>
          <th scope="col">Body</th>
          <th scope="col">Date</th>
        </tr>
      </thead>
      <tbody>

        <?php

          while($post = mysqli_fetch_assoc($posts)){
            $id = $post['id'];

            echo "<tr>
                    <td>$id</td>
                  </tr>";
          }

        ?>

        </tr>
      </tbody>

    </table>

</div>

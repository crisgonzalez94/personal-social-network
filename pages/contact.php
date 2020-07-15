<div class="container">
  <h1>Contact</h1>

  <div class="card mb-3">
    <div class="row no-gutters">

      <div class="col-md-8">
        <div class="card-body">

          <form action="index.php?page=contact" method="post">
            <div class="ui massive form">

                <div class="field">
                  <label>Name</label>
                  <input placeholder="Anna Lopez" type="text" name="name" required>
                </div>
                <div class="field">
                  <label>Email</label>
                  <input placeholder="example@email.com" type="email" name="email" required>
                </div>
                <div class="field">
                  <label>Mensage</label>
                  <textarea name="message" rows="8" cols="80" required>How are you John Smith...</textarea>
                </div>

              <button type="submit" class="btn btn-dark btn-lg btn-block">Send Message</button>
            </div>

          </form>

        </div>
      </div>

      <div class="col-md-4 box-contact-icon">
        <img src="assets/images/icons/send.svg" alt="" class="contact-icon">
      </div>

    </div>
  </div>

  <br>

</div>

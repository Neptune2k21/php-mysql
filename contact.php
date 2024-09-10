<form action="submit_contact.php" method="get">
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>
  <div class="mb-3">
    <label for="message" class="form-label">Votre message</label>
    <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Envoyer</button>
</form>

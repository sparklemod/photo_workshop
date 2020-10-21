<?php 
include "header.php";
?>

<main class="pt-5">
  <div class="container" style="max-width: 500px;">
    <form method="POST" action="actions.php" class="form-signin">
  
      <h1 class="h2 mb-5 font-weight-normal">Регистрация пользователя</h1>
      <input type="hidden" name="signup">

      <div class="form-group">
        <label for="inputEmail">Имя</label>
        <input type="text"  class="form-control" placeholder="Иван" name="first-name" required autofocus>
      </div>

      <div class="form-group">
        <label for="inputEmail">Фамилия</label>
        <input type="text"  class="form-control" placeholder="Иванов" name="last-name" required >  
      </div>

      <div class="form-group">
        <label for="inputEmail">Логин</label>
        <input type="email" class="form-control" placeholder="Email" name="login" required >
      </div>

      <div class="form-group">
        <label for="inputPassword">Пароль</label>
        <input type="password" class="form-control"  placeholder="Пароль" name="password" required>
        </div>
      
      <button class="btn btn-accent text-white btn-lg  btn-block" type="submit">Зарегистрироваться</button>
  
  
    </form>
  </div>

</main>
<?php 
include "footer.php";
?>

<div class="create-course-form">
  <form action="create.php" method="post">
    <div class="form-create__item">
      <label for="name" class="form-create__label">Наименование курса</label>
      <input type="text" class="form-create__input" id="name" name="name">
    </div>
    <div class="form-create__item">
      <label for="desc" class="form-create__label">Описание</label>
      <textarea class="form-create__input" name="desc" id="desc"></textarea>
    </div>
    <div class="form-create__item">
      <label for="price" class="form-create__label">Стоимость</label>
      <input type="number" step="0.01" class="form-create__input" name="price" id="price">
    </div>
    <div class="form-create__item">
      <label for="dates" class="form-create__label">Дата начала</label>
      <input type="datetime-local" class="form-create__input" name="dates" id="dates">
    </div>
    <button type="submit">Создать</button>
  </form>
</div>
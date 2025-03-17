<section class="myerrmodal" id="err-modal">
  <div>
    <div class="text-end">
      <button class="btn btn-outline-dark" id="close-err-modal"><i class="bi bi-x"></i></button>
    </div>
    <h1 class="h1 text-center">
      <?= $_SESSION["err"]["err"] ? '<i class="h1 text-danger bi bi-file-earmark-excel"></i>':  '<i class="h1 text-success bi bi-check2-circle"></i>'?>
    </h1>
    <h3 class="h3 text-center mt-3 mb-5"><?= $_SESSION["err"]["msg"] ?></h3>
  </div>
</section>
<script>
  const closeErrModal =document.querySelector("#close-err-modal");
  const errModal =document.querySelector("#err-modal");

  closeErrModal.addEventListener("click", () => {
    errModal.remove();
  })
</script>
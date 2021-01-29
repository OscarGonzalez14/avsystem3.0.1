<!-------------------------------->
<head>
  <meta charset="utf-8">
<a href="https://cdnjs.cloudflare.com/ajax/libs/css-layout/1.1.1/css-layout.min.js"></a>
</head>


<style>
.grid-container {
  display: grid;
  grid-template-columns: auto auto auto auto;
  grid-gap: 10px;
  background-color: #2196F3;
  padding: 10px;
}

.grid-container > div {
  background-color: rgba(255, 255, 255, 0.8);
  text-align: center;
  padding: 20px 0;
  font-size: 30px;
}

.item1 {
  grid-column: 1 /1;
}
</style>



<div class="grid-container">
  <button class="btn1"> boton1</button>
</div>
<div>
  <button class="btn2">boton2</button>
</div>
<div>
  <button class="btn3"> boton3</button>
</div>
<div>
  <button class="btn4"> boton4</button>
</div>
<div>
  <button class="btn5"> boton 5 </button>
</div>
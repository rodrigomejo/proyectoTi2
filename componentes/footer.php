   <Footer>
      <div class="contenedorFooter">
         <div class="cardFooter">
                <div class="logo">
                    <img src="./img/2103622.png" alt="">
                </div>
                <div class="terms">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Harum reiciendis et quasi aut facere vitae vero. Inventore, minus ab voluptate modi repellat, pariatur tempora quisquam
                </div>
         </div>
         <div class="cardFooter">
                <h2>Compania</h2>
                <a href="#">Acercda de</a>
                <a href="#">Contacto</a>              
         </div>
         <div class="cardFooter">
            <h2>Redes Sociales</h2>
            <a href="#"><i class="fab fa-facebook-square"></i> Facebook</a>
            <a href="#"><i class="fab fa-twitter-square"></i> Twitter</a>
            <a href="#"><i class="fab fa-linkedin"></i> Linkedin</a>
            <a href="#"><i class="fab fa-instagram-square"></i> Instagram</a>
         </div>
         </div>
         <div class="divFooter">
            <hr>
            <p>Todos los derechos reservados © 2021</p>
         </div>
   </Footer>
   <?php for ($i=0; $i < count($script) ; $i++) { 
          echo $script[$i];
         }
   ?>
   
</body>
</html>

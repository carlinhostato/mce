<!-- start flexslider -->
                    <div class="flexslider">
                      <ul class="slides">
                        <li>
                          <img src="img/dummies/blog/espinho2.jpg" alt="" />
                        </li>
                        <li>
                          <img src="img/dummies/blog/espinho3.jpg" alt="" />
                        </li>
                      </ul>
                    </div>
                    <!-- end flexslider -->
                  </div>
			<section class="callaction">
			<div class="container">
			<div class="row">
			<div class="span12">
			<div class="big-cta">
            <div class="cta-text">
                <h3>Subscreva a nossa<span class="highlight"><strong> Newsletter</strong></span></h3>
              </div>
			  <div class="span12 form-group">
				<form action="" method="POST">
                  <input type="email" class="form-control" value="" name="email" id="" placeholder="Insira o seu email" required="required"  />
                  <div class="validation"></div>
              
				<p><input type="checkbox" required><size>&nbsp;Li a <span class="highlight"><strong> política de privacidade</strong></span></p>
				
                <p><input type="submit" name="submit" value="Subscrever"></p>
				</form>
				  </div>
              </div>
            </div>
          </div>                                                  
        </div>
		</div>
		</section>
				  <?php 
                    if(isset($_POST['submit'])){
                        $email=$_POST['email'];

                        $query="select email from newsletter where email='".$email."'";
                        $result=mysqli_query($ligax,$query);
                        $n=mysqli_num_rows($result);
                        if($n!=1){
                           
                           
                            $inserir="INSERT INTO newsletter (email, ativo, data_hora) VALUES ('".$email."', 0,now())";
                            $result=mysqli_query($ligax, $inserir);
                            if($result==1){
                            include ("enviar_link_email_newsletter.php");
                            }
                        }
                    }
                    ?>
					
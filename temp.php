			
				if($now->getTimestamp() > $time_obj ){
					
                    $sql2 = "SELECT username as user, MAX(bid) as bid FROM winner WHERE Id=$id ";
                    $row44 = mysqli_query($conn, $sql2);

                    if ($row44->num_rows > 0) {
                        $row3 = mysqli_fetch_assoc($row44);
        
                     ?>
                        <div class="product-name">Winner : <?php echo $row3['user'] ?> </div>
                        <div class="product-name">Max Bid : <?php echo $row3['bid'] ?> ৳ </div>	

                    <?php } }

                
            else{
                ?>
                <div class="product-name"><h5>Ending : <?php echo $row['eventdt'] ?></h5> </div>
                
                <div class="text-secondary text-uppercase"><Strong>Current Bid : <?php echo $row['Price'] ?>৳</Strong> </div>

                <a href="Product/view.php?id=<?php echo $row['Id'] ?>&username=<?php echo $username; ?>&identity=<?php echo $identity; ?>"><button class="">BID & MORE</button></a>
                
        <?php	}
                ?>
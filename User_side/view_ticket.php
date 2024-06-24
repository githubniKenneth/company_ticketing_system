<?php
    include ('header.php');

?>
            
            <h2 class="mt-5">Subject of the Ticket</h2>
            <p class="text-dark col-7">December 09, 2022</p>
            <p class="text-dark col-7">Ticket description Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis, repellendus?</p>

            <form class="form-container my-3">
                <div class="form-group">
                    <label for="">Send a reply</label><br>
                    <textarea name="" id="" cols="50" rows="5" placeholder="Enter your message here"></textarea><br> 
                </div>
                <div class="form-group">
                    <label for="">Attach image if needed</label>
                    <input type="file" class="form-control-file">
                </div>
                <button type="button" data-toggle="modal" data-target="#addTicketModal" class="btn btn-primary">Send</button>   
            </form>

            <ul class="list-group list-unstyled">
                <li class="border border-secondary my-2 col-7">
                    <div class="d-flex justify-content-between">
                        <h4>Name of User</h4>
                        <p><i>5 hours ago</i></p>
                    </div>
                    <ul>
                        <li class="list-unstyled">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos itaque error nulla aut, tenetur earum ratione dolorum architecto doloremque, incidunt quis officia cumque. Atque reiciendis voluptates nisi. Quae nostrum minus sunt excepturi illo porro vitae ea impedit distinctio sed ipsam veritatis commodi tempora, iure illum quis temporibus libero est suscipit.</li>
                    </ul>
                </li>
                <li class="border border-secondary  my-2 col-7">
                    <div class="d-flex justify-content-between">
                        <h4>Administrator</h4>
                        <p><i>5 minutes ago</i></p>
                    </div>
                    <ul>
                        <li class="list-unstyled">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nobis maxime veniam autem placeat praesentium facere est dignissimos voluptatem sequi dolor?</li>
                    </ul>
                </li>
                <li class="border border-secondary my-2 col-7">
                    <div class="d-flex justify-content-between">
                        <h4>Name of User</h4>
                        <p><i>5 seconds ago</i></p>
                    </div>
                    <ul>
                        <li class="list-unstyled">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos itaque error nulla aut, tenetur earum ratione dolorum architecto doloremque, incidunt quis officia cumque. Atque reiciendis voluptates nisi. Quae nostrum minus sunt excepturi illo porro vitae ea impedit distinctio sed ipsam veritatis commodi tempora, iure illum quis temporibus libero est suscipit.</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            $("#sidebarCollapse").on('click', function(){
            $("#sidebar").toggleClass('active')
            })
        })
    </script>

</body>
</html>
<navbar>
    <div method="POST" action="#"  class="tab-bar">
        <a id="home" class="like-bar-button dislike-icon" href="no.php?id=<?php echo $_GET['id']  ?>">
            <i data-lucide="x"></i>
            
        </a>
        <a class="like-bar-button like-icon " id="calendrier" href="yes.php?id=<?php echo $_GET['id']  ?>"  >
            <i data-lucide="heart"></i>
         
        </a> 

        

        
</div>
</navbar>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body>
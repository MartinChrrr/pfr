<navbar class="tab-bar">
        <div id="home" class="tab-icon inactive" onclick="setInactive('home')">
            <i data-lucide="house"></i>
            
        </div>
        <div class="tab-icon inactive" id="calendrier"  onclick="setInactive('calendrier')">
            <i data-lucide="calendar-days"></i>
         
        </div> 
        <div class="tab-main">
            <i data-lucide="plus"></i>

        </div>
        <div class="tab-icon active" id="chat"  onclick="setInactive('chat')">
            <i data-lucide="message-circle-more"  ></i>
          
        </div>
        <div class="tab-icon inactive" id="profil"  onclick="setInactive('profil')">
            <i  data-lucide="user" ></i>
        </div>
        
 
    </navbar>

    <script src="./view/bar.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body>
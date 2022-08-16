        </div>
        <script>
            const dashboardComponent = {
                openSideNav: (button)=>{
                    document.getElementById(button).addEventListener('click', ()=>{
                        document.getElementById("mySidenav").style.width = "270px";
                        document.getElementById("main").style.marginLeft = "270px";
                        document.getElementById("toggle-close").classList.remove('invisible');
                        document.getElementById("toggle-close").classList.add('visible');
                        document.getElementById("toggle-open").classList.remove('visible');
                        document.getElementById("toggle-open").classList.add('invisible');
                    });
                },
                closeSideNav: (button)=>{
                    document.getElementById(button).addEventListener('click', ()=>{
                        document.getElementById("mySidenav").style.width = "0";
                        document.getElementById("main").style.marginLeft= "0";
                        document.getElementById("toggle-open").classList.remove('invisible');
                        document.getElementById("toggle-open").classList.add('visible');
                        document.getElementById("toggle-close").classList.remove('visible');
                        document.getElementById("toggle-close").classList.add('invisible');
                    });
                },
                
            }
            dashboardComponent.openSideNav('toggle-open');
            dashboardComponent.closeSideNav('toggle-close');
                
        </script>
        <script src="<?=base_url('public/bootstrap.bundle.js');?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
        
    </body>
</html>
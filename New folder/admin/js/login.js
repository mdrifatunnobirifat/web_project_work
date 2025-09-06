function check()
            {
                var id=document.getElementById("id").value;
                var pass=document.getElementById("pass").value;
               document.getElementById("iderror").textContent='';
               document.getElementById("passerror").textContent='';
                if(id===''|| id===null ||pass==='' ||pass===null)
                {
                alert("fill-up the blocks");
                return false;
                }
                 if(id==='22-47527-2'&& pass==='012345')
                {  window.location.href="../view/Aiub .html";
                return false;
                }
                 if(id!=='22-47527-2')
                { document.getElementById("iderror").textContent="invalid user id,please try again";
                  return false;
                }
                if(pass!=='012345')
                {
                    document.getElementById("passerror").textContent="invalid password";
                  return false;
                }
              return true;
        }
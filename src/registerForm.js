import { getFullHostname , request , createModal, validateFieldsForm } from "./helpers.js";

export const handleFormRegister = () =>{    
    // Create form action submit for inputs email_register and password_register throught post method
    const form = document.getElementById('registerForm');
    form.addEventListener('submit', async(event) => {

        event.preventDefault();

        const formData = Object.fromEntries(new FormData(event.target));
                    
        if (!await validateFieldsForm( formData , 'register' )){
            return; 
        }

        const headers = {
            'Content-Type': 'application/json'
        };

        const response = await request(
            `${getFullHostname()}/api/user/register.php`,
            'POST',
            headers,
            formData,
            'json'
        )

        if(response.status === 'success'){
            createModal(response.status, 'Success' , response.message);
            form.reset(); // Reset form inputs
            // Redirect to login page when close modal
            setTimeout(() =>{
                document.getElementById('btn_ok').addEventListener('click', () => {
                    window.location.href = 'login.php';
                });
            },500);
            
        } else {
            createModal(response.status, 'Error' , response.error);
        }

    });
}
import { getFullHostname , request , createModal, validateFieldsForm } from "./helpers.js";

export const handleFormLogin = () =>{    
    // Create form action submit for inputs email_register and password_register throught post method
    const form = document.getElementById('loginForm');
    form.addEventListener('submit', async(event) => {

        event.preventDefault();

        const formData = Object.fromEntries(new FormData(event.target));
            
        if (!await validateFieldsForm( formData , 'login' )){
            return;
        }

        const headers = {
                'Content-Type': 'application/json'
        };

        try {
            const response = await request(
                `${getFullHostname()}/api/user/login.php`,
                'POST',
                headers,
                formData,
                'json'
            );

            if(response.status === 'success'){
                window.location.href = "dashboard.php";
            } else {
                createModal(response.status, 'Error' , response.error);
            }

        } catch (error) {
            console.error(error);
            createModal('Error', 'Error' , 'An error occurred, please try again later or contact the administrator');
        }

    });
}
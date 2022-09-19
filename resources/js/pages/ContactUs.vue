<template>
    <div class="container">
        <h1>Contact us</h1>

        <div v-if="success" class="alert alert-primary" role="alert">
            Thank's for contacting us
        </div>

        <form @submit.prevent="sendMessage">
            <div class="mb-3">
                <label for="user-name" class="form-label">Name</label>
                <input v-model="userName" type="text" class="form-control" id="user-name" placeholder="Your name">

                <div v-if="errors.name">
                    <div v-for="error, index in errors.name" :key="index" class="alert alert-danger" role="alert">
                        {{error}}
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="user-email" class="form-label">Email address</label>
                <input v-model="userEmail" type="email" class="form-control" id="user-email" placeholder="Your email">
            
                <div v-if="errors.email">
                    <div v-for="error, index in errors.email" :key="index" class="alert alert-danger" role="alert">
                        {{error}}
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="user-message" class="form-label">Message</label>
                <textarea v-model="userMessage" class="form-control" id="user-message" placeholder="Write her your message" rows="5"></textarea>
            
                <div v-if="errors.message">
                    <div v-for="error, index in errors.message" :key="index" class="alert alert-danger" role="alert">
                        {{error}}
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>

    </div>
</template>

<script>
export default {
    name: 'ContactUs',
    data() {
        return {
            userName: '',
            userEmail: '',
            userMessage: '',
            // aggiungo success ai data con def false
            success: false,
            // oggetto vuoto dove si salveranno gli errori
            errors: {}
        };
    },
    methods: {
        sendMessage(){
            axios.post('/api/leads', {
                name: this.userName,
                email: this.userEmail,
                message: this.userMessage
            })
            .then ((response) =>{
                // gli dico che se dalla chiamata api, questo success torna true
                if(response.data.success){
                    // anche questo success diventa true,
                    // si verifica quindi la condizione per stampare l'altert in pagina
                    this.success = true;

                    this.userName ='';
                    this.userEmail ='';
                    this.userMessage ='';
                } else {
                    // altrimenti, salva gli errori errors{}
                    this.errors = response.data.errors;
                }        
            })
        }
    }
}
</script>
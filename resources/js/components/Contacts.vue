<template>
    <div class="content">
        <div class="card">
            <h5 class="card-header">Add Contact</h5>
            <div class="card-body">
                <div class="col-md-8">
                    <form action="#" @submit.prevent="edit?updateContact(contact.id) : createContact()">
                        
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" v-model="contact.name" class="form-control" id="name" name="name" placeholder="Enter name">
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" v-model="contact.email" class="form-control" id="email" name="email" placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="phone" v-model="contact.phone" class="form-control" id="phone" name="phone" placeholder="Enter phone">
                        </div>
                        
                        <div class="form-group">
                          <button v-show="!edit" type="submit" class="btn btn-primary">Create contact</button>
                          <button v-show="edit" type="submit" class="btn btn-primary">Update contact</button>
                        </div>
                        
                    </form>
                </div>
            </div>
            <h5 class="card-footer">List Contact</h5>
            <ul class="list-group">
                <li class="list-group-item" v-for="contact in list">
                    {{ contact.name }} {{ contact.email }} {{ contact.phone}}
                    
                    <button type="button" @click="deleteContact(contact.id)" class="btn btn-danger btn-sm float-right" style="margin-left:4px">delete</button>
                    <button type="button" @click="showContact(contact.id)" class="btn btn-info btn-sm float-right" >Edit</button>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                edit : false,
                list : [],
                contact : {
                    id : '',
                    name : '',
                    email : '',
                    phone : ''
                }
            }
        },

        mounted() {
            console.log('Contacts compnents loaded...');
            this.fetchContactList();
        },

        methods : {
            fetchContactList : function(){
                console.log('Fetch Contact..');
                axios.get('api/contacts')
                .then((response)=>{
                    console.log(response.data);
                    this.list = response.data;
                }).catch((e) => {
                    console.log(e);
                });
            },
            createContact : function(){
                console.log('Create contact');
                let self = this;
                let params = Object.assign({},self.contact);
                axios.post('api/contact/store',params)
                .then(() => {
                    self.contact.name = '';
                    self.contact.email = '';
                    self.contact.phone = '';
                    self.edit   = false;
                    self.fetchContactList();
                }).catch((e) => {
                    console.log(e);
                });
            },
            showContact : function(id){
                let self = this;
                axios.get('api/contact/'+id)
                .then(function(response){
                    self.contact.id = response.data.id;
                    self.contact.name = response.data.name;
                    self.contact.email = response.data.email;
                    self.contact.phone = response.data.phone;
                })
                self.edit  = true;
            },

            updateContact : function(id){
                //console.log('Update contact'+ id);
                let self = this;
                let params = Object.assign({},self.contact);
                axios.patch('api/contact/'+id,params)
                .then(() => {
                    self.contact.name = '';
                    self.contact.email = '';
                    self.contact.phone = '';
                    self.edit   = false;
                    self.fetchContactList();
                }).catch((e) => {
                    console.log(e);
                });
            },
            // es6 not working 
            // deleteContact: function(id){
            //     axios.delete('api/contact/'+id)
            //     .then(function(response){
            //         self.fetchContactList();
            //     })
            //     .catch(function(error){
            //         console.log(error);
            //     });
            // }

            // using arrow function 
            deleteContact: function(id) {
            axios.delete('api/contact/'+id)
                .then((response) => {
                    this.fetchContactList();
                })
                .catch((error) => {
                console.log(error);
                });
            }
        }
    }

</script>

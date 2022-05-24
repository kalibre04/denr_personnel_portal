<template>
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Edit Travel Order</h3>
    </div>
    
    <form>
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Travel Order No.</label>
                    <input type="text" v-model="toNumber" class="form-control" disabled="true"/>
                    <input type="text" v-model="id" class="form-control" disabled="true" hidden="true"/>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Current Department</label>
                    <input type="text" v-model="currentDept" class="form-control" disabled="true" />
                </div>
                <div class="form-group">
                    <!-- <label for="exampleInputEmail1">Current Department</label> -->
                    <input type="text" v-model="currentDeptid" class="form-control" hidden="true" />
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Destination</label>
                    <input type="text" v-model="destination" class="form-control" placeholder="Destination"/>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Purpose</label>
                    <textarea class="form-control" rows="3" v-model="purpose"  placeholder="Purpose of travel"></textarea>
                    
                </div>

                <div class="form-group">
                    <label>Departure Date:</label>
                    <div class="input-group">
                        
                        <div class="input-group-prepend">
                            
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="date" v-model="datedepart" class="form-control float-right">
                    </div>
                </div>
                <div class="form-group">
                    <label>Arrival Date:</label>
                    <div class="input-group">
                        
                        <div class="input-group-prepend">
                            
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="date" v-model="datearrive" class="form-control float-right">
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Per Diems/Expenses Allowed:</label>
                    <input type="text" v-model="expenses" class="form-control" placeholder="Per Diems/Expenses"/>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Assistants or Laborers Allowed:</label>
                    <input type="text" v-model="assist_labor_allowed" class="form-control" placeholder="Assistants or Laborers Allowed"/>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Remarks or Special Instructions:</label>
                    <input type="text" v-model="instructions" class="form-control" placeholder="Special Instructions"/>
                </div>
                <div class="form-group">
                    <label>Travel Type</label>
                    <select class="form-control" v-model="travel_type">
                        <option>Within AOR</option>
                        <option>Outside AOR</option>
                    </select>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" @click.prevent="approveTO()" class="btn btn-primary">Approve</button>
                <button type="submit" @click.prevent="disapproveTO()" class="btn btn-warning">Disapprove</button>
                <button type="button" @click="back" class="btn btn-secondary">Back</button>
            </div>
    </form>
  </div>
</template>
<script>
export default {
  props:{
      toNumber:{
          type: String,
          required: true
      },
      destination:{
          type: String,
          required: true
      },
      currentDept:{
          type: String,
          required: true
      },
      datedepart:{
          type: Date,
          required: true
      },
      datearrive:{
          type: Date,
          required: true
      },
      expenses:{
          type: String,
          required: true
      },
      assist_labor_allowed:{
          type: String,
          required: true
      },
      instructions:{
          type: String,
          required: true
      },
      travel_type:{
          type: String,
          required: true
      },
      purpose:{
          type: String,
          required: true
      },
      id:{
          type: String,
          required: true
      }

  },
  
  data() {
    return {
      destination: "",
      purpose: "",
      datedepart: "",
      datearrive: "",
      expenses: "",
      assist_labor_allowed: "",
      instructions: "",
      toNumber: "",
      currentDept: "",
      currentDeptid: "",
      travel_type: "",
      error: false,
      successful: false,
      errors: []
      
    };
  },
  mounted() {
    //console.log('Component Mounted')
    //this.sampleMount();
    
  },
  methods: {
            disapproveTO(){
            Swal.fire({
            title: 'Are you sure you want to decline this Travel Order?',
                text: "kindly state why",
                input: 'textarea',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',

                }).then((result) => {
                    if (result.isConfirmed) {
                        //console.log(result);   
                        axios.patch('disapproveto/' + this.id, result).then(response => {
                            if(response.data.message == "Travel Order Disapproved"){
                                Swal.fire({
                                title: 'Success!',
                                text: response.data.message,
                                icon: 'success',
                                confirmButtonText: 'Okay'
                                }).then(function() {
                                    window.location = "/denr_personnel_portal/travel/cenroindex";
                                });
                            }else{
                                Swal.fire({
                                title: 'Oops!',
                                text: response.data.message,
                                icon: 'warning',
                                confirmButtonText: 'Okay'
                                });
                            }
                        });
                    }
                })
            },

            approveTO() {
            axios.post("updateto/"+ this.id, {
                destination : this.destination,
                purpose : this.purpose,
                datedepart : this.datedepart,
                datearrive : this.datearrive,
                expenses : this.expenses,
                assist_labor_allowed : this.assist_labor_allowed,
                instructions : this.instructions,
                toNumber : this.toNumber,
                currentDept: this.currentDept,
                travel_type: this.travel_type,
                currentDeptid: this.currentDeptid,
                id: this.id
                })
                .then(response => {

                    if(response.data.message == 'Travel Order Approved'){
                        Swal.fire({
                            title: 'Success!',
                            text: response.data.message,
                            icon: 'success',
                            confirmButtonText: 'Okay'
                        }).then(function() {
                            window.location = "/denr_personnel_portal/travel/cenroindex";
                        });

                    }else{
                        Swal.fire({
                            title: 'Oops...',
                            text: 'fill out required fields',
                            icon: 'error',
                            confirmButtonText: 'Okay'
                        })


                    }
                }).catch(error => {
                    
                    if (!_.isEmpty(error.response)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                        if ((error.response.status = 422)) {
                            this.errors = error.response.data.errors;
                            this.successful = false;
                            this.error = true;
                            this.submitted = false;
                        }
                    }
                });
            },

            back(){
                window.location.href='/denr_personnel_portal/travel/cenroindex';
            }
  },
};
</script>

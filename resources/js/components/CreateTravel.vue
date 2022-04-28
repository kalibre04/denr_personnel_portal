<template>
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Create Travel Order</h3>
    </div>

    <form>
            <div class="card-body">
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
            </div>

            <div class="card-footer">
                <button type="submit" @click.prevent="submitTO" class="btn btn-primary">Submit</button>
                <button type="button" @click="back" class="btn btn-primary">Cancel</button>
            </div>
    </form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      destination: "",
      purpose: "",
      datedepart: "",
      datearrive: "",
      expenses: "",
      assist_labor_allowed: "",
      instructions: "",
    };
  },
  mounted() {
    console.log('Component Mounted')
  },
  methods: {
            submitTO() {
            axios.post('saveto', {
                destination : this.destination,
                purpose : this.purpose,
                datedepart : this.datedepart,
                datearrive : this.datearrive,
                expenses : this.expenses,
                assist_labor_allowed : this.assist_labor_allowed,
                instructions : this.instructions
                })
                .then(response => console.log(response));
            },
            back(){
                window.location.href='/denr_personnel_portal/Travel';
            }
  },
};
</script>

<template>
    <div id="wrapper">
    <h1>Find your perfect apartment</h1>

    <el-form ref="form" :model="form" label-width="120px">
  <el-form-item label="Name">
    <el-input v-model="form.name"></el-input>
  </el-form-item>

  <el-row :gutter="20">
    <el-col :span="12">
    <el-switch
      active-text="Include bedrooms in search"
      v-model="include.bedrooms"
      :active-value="true"
      :inactive-value="false">
    </el-switch>
    <el-form-item label="Bedrooms">
      <el-input-number  size="mini" :disabled="!include.bedrooms" v-model="form.bedrooms" :min="0" :max="10"></el-input-number>
    </el-form-item>
    <el-switch
      active-text="Include bathrooms in search"
      v-model="include.bathrooms"
      :active-value="true"
      :inactive-value="false">
    </el-switch>
  <el-form-item label="Bathrooms">
    <el-input-number size="mini" :disabled="!include.bathrooms" v-model="form.bathrooms" :min="0" :max="10"></el-input-number>
  </el-form-item>

  </el-col>
  <el-col :span="12">
  <el-switch
  active-text="Include storeys in search"
  v-model="include.storeys"
  :active-value="true"
  :inactive-value="false">
</el-switch>
  <el-form-item label="Storeys">
    <el-input-number  size="mini" :disabled="!include.storeys" v-model="form.storeys" :min="0" :max="10"></el-input-number>
  </el-form-item>
  <el-switch
  active-text="Include garages in search"
  v-model="include.garages"
  :active-value="true"
  :inactive-value="false">
</el-switch>
  <el-form-item label="Garages">
    <el-input-number size="mini" :disabled="!include.garages" v-model="form.garages" :min="0" :max="10"></el-input-number>
  </el-form-item>
</el-col>
  </el-row>
  <el-form-item label="Price range">
  <div class="block">
    <el-slider
      v-model="form.price"
      range
      :max="1000000">
    </el-slider>
  </div>
  </el-form-item>
  <el-button type="primary" @click="onSubmit">Submit</el-button>
</el-form>

<el-table
      v-loading="loading"
      :data="tableOutput"
      style="width: 100%"
      empty-text="No apartments are found">
      <el-table-column
        prop="name"
        label="Name">
      </el-table-column>
      <el-table-column
        prop="bedrooms"
        label="Bedrooms">
      </el-table-column>
      <el-table-column
        prop="bathrooms"
        label="Bathrooms">
      </el-table-column>
      <el-table-column
        prop="storeys"
        label="Storeys">
      </el-table-column>
      <el-table-column
        prop="garages"
        label="Garages">
      </el-table-column>
</el-table>


</div>
</template>
<script>
import axios from 'axios';
export default {
    
    name: "SearchForm",
    
    data() {
      return {
        form: {
          name: '',
          price: [0, 10000000],
          garages: null,
          storeys: null,
          bathrooms: null,
          bedrooms: null,
        },
        include: {
          garages: false,
          storeys: false,
          bathrooms: false,
          bedrooms: false,
        },
        loading: false,
        tableOutput: []
      
      }
    },
    methods: {
      onSubmit() {
        this.loading = true
        let data = new FormData();

        data.append('name', this.form.name);
        data.append('price', this.form.price);
        if(this.include.garages){
          data.append('garages', this.form.garages);
        }
        if(this.include.storeys){
          data.append('storeys', this.form.storeys);
        }
        if(this.include.bedrooms){
          data.append('garages', this.form.bedrooms);
        }
        if(this.include.bathrooms){
          data.append('garages', this.form.bathrooms);
        }

        axios.post('api/houses/search', data)
        .then(response => this.tableOutput = response.data.data)
        .catch(error => console.log(error))
        .finally(this.loading = false)
      },
    }
}
</script>
<style>
    #wrapper {
        margin-left: 10%;
        margin-right: 10%;
    }
</style>
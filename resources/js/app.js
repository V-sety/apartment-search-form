require('./bootstrap');

import Vue from 'vue'
import ElementUI from 'element-ui';
import SearchForm from './components/SearchForm'
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/en'

Vue.use(ElementUI, {locale});

Window.vue = new Vue({

	el:'#app',
	components: {
		SearchForm
	}
});
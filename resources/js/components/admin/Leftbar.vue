<template>
	<div class="fixed-plugin" @click="init">
		<a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
			<i class="fa fa-cog py-2"> </i>
		</a>
		<div class="card shadow-lg">
			<div class="card-header pb-0 pt-3 ">
				<div class="float-start">
					<h5 class="fs-6 mt-3 mb-0">Panel de configuraciones</h5>
				</div>
				<div class="float-end mt-3">
					<button class="btn btn-link p-0 fixed-plugin-close-button">
						<i class="fa fa-close"></i>
					</button>
				</div>
			</div>
			<hr class="horizontal dark my-1">
			<div class="card-body pt-sm-3 pt-0 overflow-auto">
				<div class="mt-2 mb-5 d-flex">
					<p class="fs-7 mb-0"><i class="lni lni-sun me-1"></i>Claro / <i class="lni lni-night me-1"></i>Oscuro</p>
					<div class="form-check form-switch ps-0 ms-auto my-auto">
						<input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" @change="theme">
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import { mapState } from 'vuex'

export default
{
    components:
	{
    
	},

    data() 
	{
        return {

        }
    },
    mounted()
	{
		this.init()
		let check = document.getElementById('dark-version')
		let theme = localStorage.getItem('theme')
		if(theme == 1)
		check.checked = false
		else
		check.checked = true
    },

    computed: mapState(['module']),

    methods:
	{
        init()
		{
			// Fixed Plugin
			if (document.querySelector('.fixed-plugin')) 
			{
				let fixedPlugin = document.querySelector('.fixed-plugin');
				let fixedPluginButton = document.querySelector('.fixed-plugin-button');
				let fixedPluginButtonNav = document.querySelector('.fixed-plugin-button-nav');
				let fixedPluginCard = document.querySelector('.fixed-plugin .card');
				let fixedPluginCloseButton = document.querySelectorAll('.fixed-plugin-close-button');
				let navbar = document.getElementById('navbarBlur');
				let buttonNavbarFixed = document.getElementById('navbarFixed');

				if (fixedPluginButton)
				{
					fixedPluginButton.onclick = function()
					{
						if (!fixedPlugin.classList.contains('show'))
						{
							fixedPlugin.classList.add('show');
						}
						else
						{
							fixedPlugin.classList.remove('show');
						}
					}
				}

				if (fixedPluginButtonNav)
				{
					fixedPluginButtonNav.onclick = function()
					{
						if (!fixedPlugin.classList.contains('show'))
						{
							fixedPlugin.classList.add('show');
						} 
						else
						{
							fixedPlugin.classList.remove('show');
						}
					}
				}

				fixedPluginCloseButton.forEach(function(el)
				{
					el.onclick = function()
					{
						fixedPlugin.classList.remove('show');
					}
				})

				document.querySelector('body').onclick = function(e)
				{
					if (e.target != fixedPluginButton && e.target != fixedPluginButtonNav && e.target.closest('.fixed-plugin .card') != fixedPluginCard)
					{
						fixedPlugin.classList.remove('show');
					}
				}

				if (navbar)
				{
					if (navbar.getAttribute('data-scroll') == 'true' && buttonNavbarFixed)
					{
						buttonNavbarFixed.setAttribute("checked", "true");
					}
				}

			}
		},

		theme(e)
		{
			let el = e.target
			const body = document.getElementsByTagName('body')[0]
			if (e.target.checked)
			{
				body.classList.add('dark-version')	
				localStorage.setItem('theme',0)
			}
			else
			{
				body.classList.remove('dark-version')
				localStorage.setItem('theme',1)
			} 
		}
    },
}
</script>
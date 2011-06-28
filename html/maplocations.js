
var MapLocations = new Class(
{
	container: null,
	posdesc_timer: null,
	active_posdesc: null,
	
	Binds: ['show_posdesc', 'hide_posdesc', 'fire_posdesc', 'stop_posdesc'],
	
	initialize: function(container)
	{
		this.container = document.id(container);
		
		this.container.getElements('.mappin img').addEvent('mouseout', this.fire_posdesc);
		this.container.getElements('.location_description').addEvent('mouseover', this.stop_posdesc).addEvent('mouseout', this.fire_posdesc);
	},

	show_posdesc: function(id)
	{
		if (this.active_posdesc) this.hide_posdesc();
		this.active_posdesc = id;
		document.id(id).setStyles({'opacity': 0, 'display':'block'}).fade('in');
	},
	
	hide_posdesc: function()
	{
		this.stop_posdesc();
		document.id(this.active_posdesc).fade('out');
	},
	
	fire_posdesc: function()
	{
		this.posdesc_timer = this.hide_posdesc.delay(200);
	},
	
	stop_posdesc: function()
	{
		$clear(this.posdesc_timer);
	}
});


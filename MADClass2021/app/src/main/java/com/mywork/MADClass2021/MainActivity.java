package com.mywork.MADClass2021;

import android.content.Intent;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.content.SharedPreferences;
import android.util.Log;
import androidx.appcompat.app.AppCompatActivity;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;


public class MainActivity extends AppCompatActivity {
    public static final String store_key = "key";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        String url  = "http://mad.mywork.gr/authenticate.php?t=XYZ";
        RequestQueue queue = Volley.newRequestQueue(MainActivity.this);
        if(getPref(store_key) != null) {
            url = "http://mad.mywork.gr/authenticate.php?t="+getPref(store_key);
        }
        StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        if (getTagValue(response, "status").toLowerCase()
                                .contains("ok")) {
                            Intent i = new Intent(MainActivity.this, MenuActivity.class);
                            i.putExtra("key", getTagValue(response, "msg"));
                            startActivity(i);
                        } else {
                            Log.e("res", response);
                            Intent i = new Intent(MainActivity.this, LoginActivity.class); 
                            startActivity(i);
                        }


                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.e("res", error.getMessage());
            }
        });

        queue.add(stringRequest);
    }

    public String getTagValue(String xmlText, String tagName) {

        String[] firstParts = xmlText.split("<" + tagName + ">");
        String[] secondParts = firstParts[1].split("</" + tagName + ">");
        System.out.println(firstParts);
        System.out.println(secondParts); //Debug status: 1-OK or 1-FAIL
        return secondParts[0];
    }
    public  String getPref(String key) {
        SharedPreferences preferences = PreferenceManager.getDefaultSharedPreferences(this);
        return preferences.getString(key, null);
    }
}
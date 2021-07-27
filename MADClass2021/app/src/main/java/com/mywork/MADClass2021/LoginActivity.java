package com.mywork.MADClass2021;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ImageButton;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

public class LoginActivity extends AppCompatActivity {

    private ImageButton chkButton;
    private EditText emailEditText;
    private TextView infoText;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        emailEditText = findViewById(R.id.emailEditText);
        chkButton = findViewById(R.id.chkButton);
        infoText = findViewById(R.id.infoText);

        chkButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Log.e("res", emailEditText.getText().toString());
                if(!emailEditText.getText().toString().equals("")) {
                    RequestQueue queue = Volley.newRequestQueue(LoginActivity.this);
                    String url = "http://mad.mywork.gr/generate_token.php?e=" + emailEditText.getText();

                    StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                            new Response.Listener<String>() {
                                @Override
                                public void onResponse(String response) {
                                    if (getTagValue(response, "status").toLowerCase()
                                            .contains("ok")) {
                                        Toast.makeText(LoginActivity.this, "Authentication Successful", Toast.LENGTH_LONG).show();
                                        Intent i = new Intent(LoginActivity.this, KeyShowActivity.class);
                                        i.putExtra("key", getTagValue(response, "msg"));
                                        startActivity(i);
                                    } else {
                                        infoText.setVisibility(View.VISIBLE);
                                        infoText.setText("Cannot identify email :" + emailEditText.getText());
                                        Toast.makeText(LoginActivity.this, "Authentication Failed", Toast.LENGTH_LONG).show();
                                    }
                                    Log.e("res", response);
                                    Log.e("res", getTagValue(response, "status"));
                                }
                            }, new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            Log.e("res", error.getMessage());
                        }
                    });

                    queue.add(stringRequest);
                }else {
                    infoText.setVisibility(View.VISIBLE);
                    infoText.setText("Field is empty");
                }
            }
        });
    }

    public String getTagValue(String xmlText, String tagName) {

        String[] firstParts = xmlText.split("<" + tagName + ">");
        String[] secondParts = firstParts[1].split("</" + tagName + ">");
        System.out.println(firstParts);
        System.out.println(secondParts); //Debug status: 1-OK or 1-FAIL
        return secondParts[0];
    }
}
apache_mod_shib
=========

Copies in the necessary directories and configuration to get shibboleth running on your Apache server.

Requirements
------------

This role expects that you have generated a key and certificate and stored those files in the local directory as defined by the `apache_mod_shib_ssl_certificate_store` variable. The name of the cert and key are defined by the `apache_mod_shib_ssl_certificate_file` and `apache_mod_shib_ssl_key_file` variables.

Role Variables
--------------

See `defaults/main.yml` for the list of variables. At a mininum, you will need to define the `apache_mod_shib_entity_id`, `apache_mod_shib_admin_email`, and `apache_mod_shib_ssl_key_password`.

### apache_mod_shib_ssl_key_password

The apache_mod_shib role assumes that you have created a private key that has
been encrypted using the password set for `apache_mod_shib_ssl_key_password`.
The encrypted file should be stored in the
`{{ apache_mod_shib_ssl_certificate_store }}/{{ apache_mod_shib_ssl_key_file }}`
directory in your local repo.

Dependencies
------------

See `meta/main.yml`

Example Playbook
----------------

Including an example of how to use your role (for instance, with variables passed in as parameters) is always nice for users too:

    - hosts: servers
      vars:
        apache_mod_shib_entity_id: "https://www.example.com/shibboleth/default"
        apache_mod_shib_admin_email: "example@example.com"
      roles:
         - { role: apache_mod_shib }


Author Information
------------------

Ian Whitney, Debbie Gillespie and Davin Lageroos @ ASR
